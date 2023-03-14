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

final class CreateResponseMessage
{
    private function __construct(
        public readonly string $role,
        public readonly string $content
    ) {
    }

    /**
     * @param array{role:string,content:string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['role'],
            $attributes['content'],
        );
    }

    /**
     * @return array{role:string,content:string}
     */
    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }
}
