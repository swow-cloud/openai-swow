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
 * @implements Response<array{object: string, data: array<int, array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>}>
 */
final class ListResponse implements Response
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>}>
     */
    use ArrayAccessible;

    /**
     * @param array<int, RetrieveResponse> $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{object: string, data: array<int, array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>} $attributes
     */
    public static function from(array $attributes): self
    {
        $data = array_map(static fn(array $result): RetrieveResponse => RetrieveResponse::from(
            $result
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn(RetrieveResponse $response): array => $response->toArray(),
                $this->data,
            ),
        ];
    }
}
