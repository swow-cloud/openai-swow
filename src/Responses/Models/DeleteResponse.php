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

namespace SwowCloud\OpenAI\Responses\Models;

use SwowCloud\OpenAI\Contracts\Response;
use SwowCloud\OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, deleted: bool}>
 */
final class DeleteResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, deleted: bool}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly bool $deleted,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{id: string, object: string, deleted: bool} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['deleted'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'deleted' => $this->deleted,
        ];
    }
}
