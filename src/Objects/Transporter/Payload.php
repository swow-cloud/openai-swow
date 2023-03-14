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

namespace SwowCloud\OpenAI\Objects\Transporter;

use JsonException;
use Psr\Http\Message\RequestInterface;
use Swow\Psr7\Message\Request as Psr7Request;
use Swow\Psr7\Psr7;
use SwowCloud\OpenAI\Const\Chat;
use SwowCloud\OpenAI\Enum\ApiContentType;
use SwowCloud\OpenAI\Enum\ApiMethod;
use SwowCloud\OpenAI\Objects\ResourceUri;

use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_UNICODE;

final class Payload
{
    /**
     * @param array<string,mixed> $parameters
     */
    private function __construct(
        private readonly ApiContentType $apiContentType,
        private readonly ApiMethod $apiMethod,
        private readonly ResourceUri $uri,
        private readonly array $parameters = []
    ) {
    }

    /**
     * @param array<string,mixed> $parameters
     */
    public static function create(string $resource, array $parameters = []): self
    {
        $contentType = ApiContentType::JSON;
        $method = ApiMethod::POST;
        $uri = ResourceUri::create($resource);
        $parameters = [
            ...[
                'model' => Chat::CHAT_MODEL,
            ],
            ...$parameters,
        ];

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * @throws JsonException
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): Psr7Request|RequestInterface
    {
        $body = null;
        $uri = sprintf('https://%s/%s', $baseUri->toString(), $this->uri->toString());
        $headers = $headers->withContentType($this->apiContentType);

        if ($this->apiMethod === ApiMethod::POST) {
            $body = json_encode($this->parameters, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        }

        return Psr7::createRequest($this->apiMethod->value, $uri, $headers->toArray(), $body);
    }

    public static function list(string $resource): self
    {
        $contentType = ApiContentType::JSON;
        $method = ApiMethod::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieve(string $resource, string $id, string $suffix = ''): self
    {
        $contentType = ApiContentType::JSON;
        $method = ApiMethod::GET;
        $uri = ResourceUri::retrieve($resource, $id, $suffix);

        return new self($contentType, $method, $uri);
    }

    public static function delete(string $resource, string $id): self
    {
        $contentType = ApiContentType::JSON;
        $method = ApiMethod::DELETE;
        $uri = ResourceUri::delete($resource, $id);

        return new self($contentType, $method, $uri);
    }
}
