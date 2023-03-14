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

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $promptTokens,
        public readonly ?int $completionTokens,
        public readonly int $totalTokens
    ) {
    }

    /**
     * @param array{prompt_tokens: int, completion_tokens: int|null,total_tokens: int  } $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['prompt_tokens'],
            $attributes['completion_tokens'] ?? null,
            $attributes['total_tokens']
        );
    }

    /**
     * @return array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
        ];
    }
}
