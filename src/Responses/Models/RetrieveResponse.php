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
 * @implements Response<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
 */
final class RetrieveResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
     */
    use ArrayAccessible;

    /**
     * @param array<int, RetrieveResponsePermission> $permission
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly string $ownedBy,
        public readonly array $permission,
        public readonly string $root,
        public readonly ?string $parent,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string} $attributes
     */
    public static function from(array $attributes): self
    {
        $permission = array_map(static fn(array $result): RetrieveResponsePermission => RetrieveResponsePermission::from(
            $result
        ), $attributes['permission']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['owned_by'],
            $permission,
            $attributes['root'],
            $attributes['parent'],
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
            'created' => $this->created,
            'owned_by' => $this->ownedBy,
            'permission' => array_map(
                static fn(RetrieveResponsePermission $result): array => $result->toArray(),
                $this->permission,
            ),
            'root' => $this->root,
            'parent' => $this->parent,
        ];
    }
}
