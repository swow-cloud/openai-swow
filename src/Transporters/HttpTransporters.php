<?php
/**
 * This file is part of openai-swow
 *
 * @link    https://github.com/swow-cloud/openai-swow
 * @contact Peter he <847050412@qq.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code
 */

declare(strict_types=1);

namespace SwowCloud\OpenAI\Transporters;

use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use SwowCloud\OpenAI\Contracts\Transporter;
use SwowCloud\OpenAI\Exceptions\ErrorException;
use SwowCloud\OpenAI\Exceptions\TransporterException;
use SwowCloud\OpenAI\Exceptions\UnserializableResponse;
use SwowCloud\OpenAI\Objects\Transporter\BaseUri;
use SwowCloud\OpenAI\Objects\Transporter\Headers;
use SwowCloud\OpenAI\Objects\Transporter\Payload;

use const JSON_THROW_ON_ERROR;

final class HttpTransporters implements Transporter
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $header
    ) {
        // ...
    }

    /**
     * {@inheritdoc}
     */
    public function request(Payload $payload): array|string
    {
        $request = $payload->toRequest($this->baseUri, $this->header);
        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }
        $contents = (string) $response->getBody();

        if ($response->getHeader('Content-Type')[0] === 'text/plain; charset=utf-8') {
            return $contents;
        }

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (isset($response['error'])) {
            throw new ErrorException($response['error']);
        }

        return $response;
    }
}
