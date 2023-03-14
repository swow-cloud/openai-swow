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

namespace SwowCloud\OpenAI\Resources;

use JsonException;
use SwowCloud\OpenAI\Exceptions\ErrorException;
use SwowCloud\OpenAI\Exceptions\TransporterException;
use SwowCloud\OpenAI\Exceptions\UnserializableResponse;
use SwowCloud\OpenAI\Objects\Transporter\Payload;
use SwowCloud\OpenAI\Resources\Concerns\Transportable;
use SwowCloud\OpenAI\Responses\Chat\CreateResponse;

final class Chat
{
    use Transportable;

    /**
     * @param array<string, mixed> $parameters
     *
     * @throws ErrorException
     * @throws TransporterException
     * @throws UnserializableResponse|JsonException
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('v1/chat/completions', $parameters);

        /** @var array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, message: array{role: string, content: string}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}} $result */
        $result = $this->transporter->request($payload);

        return CreateResponse::from($result);
    }
}
