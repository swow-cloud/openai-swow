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

namespace SwowCloud\OpenAI\Objects;

use SwowCloud\OpenAI\Contracts\Stringable;

final class ResourceUri implements Stringable
{
    private function __construct(private readonly string $uri)
    {
    }

    public static function create(string $resource): self
    {
        return new self($resource);
    }

    public static function list(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that retrieves the given resource.
     */
    public static function retrieve(string $resource, string $id, string $suffix): self
    {
        return new self("{$resource}/{$id}{$suffix}");
    }

    public static function delete(string $resource, string $id): self
    {
        return new self("{$resource}/{$id}");
    }

    public function toString(): string
    {
        return $this->uri;
    }
}
