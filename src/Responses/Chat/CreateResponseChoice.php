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

namespace SwowCloud\OpenAI\Responses\Chat;

final class CreateResponseChoice
{
    private function __construct(
        public readonly int $index,
        public readonly CreateResponseMessage $message,
        public readonly ?string $finishReason
    ) {
    }

    /**
     * @param array{index: int, message: array{role: string, content: string}, finish_reason: string|null} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'],
            CreateResponseMessage::from($attributes['message']),
            $attributes['finish_reason']
        );
    }

    /**
     * @return array{index: int, message: array{role: string, content: string}, finish_reason: string|null}
     */
    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'message' => $this->message->toArray(),
            'finish_reason' => $this->finishReason,
        ];
    }
}
