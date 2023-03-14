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

namespace SwowCloud\OpenAI\Contracts;

use ArrayAccess;

/**
 * @template TArray of array
 * @extends ArrayAccess<key-of<TArray>, value-of<TArray>>
 * @internal
 */
interface Response extends ArrayAccess
{
    /**
     * Returns the array representation of the Response.
     *
     * @return TArray
     */
    public function toArray(): array;

    /**
     * @param key-of<TArray> $offset
     */
    public function offsetExists(mixed $offset): bool;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param TOffsetKey $offset
     *
     * @return TArray[TOffsetKey]
     */
    public function offsetGet(mixed $offset): mixed;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param TOffsetKey $offset
     * @param TArray[TOffsetKey] $value
     */
    public function offsetSet(mixed $offset, mixed $value): never;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param TOffsetKey $offset
     */
    public function offsetUnset(mixed $offset): never;
}
