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

final class ApiKey implements Stringable
{
    private function __construct(public readonly string $apiKey)
    {
    }

    /**
     * @return $this
     */
    public static function from(string $key): self
    {
        return new self($key);
    }

    public function toString(): string
    {
        return $this->apiKey;
    }
}
