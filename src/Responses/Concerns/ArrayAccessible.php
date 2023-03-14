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

namespace SwowCloud\OpenAI\Responses\Concerns;

use BadMethodCallException;
use SwowCloud\OpenAI\Contracts\Response;

use function array_key_exists;

/**
 * @template TArray of array
 * @mixin Response<TArray>
 */
trait ArrayAccessible
{
    /**
     * {@inheritDoc}
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet(mixed $offset, mixed $value): never
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset(mixed $offset): never
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
