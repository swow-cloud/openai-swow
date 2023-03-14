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

namespace SwowCloud\OpenAI\Objects\Transporter;

use SwowCloud\OpenAI\Const\Chat;
use SwowCloud\OpenAI\Contracts\Stringable;

final class BaseUri implements Stringable
{
    private function __construct(private readonly string $baseUri)
    {
    }

    public static function from(?string $baseUri = null): self
    {
        $baseUri ??= Chat::BASE_URI;
        return new self($baseUri);
    }

    public function toString(): string
    {
        return $this->baseUri;
    }
}
