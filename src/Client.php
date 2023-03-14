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

namespace SwowCloud\OpenAI;

use SwowCloud\OpenAI\Contracts\Transporter;
use SwowCloud\OpenAI\Resources\Chat;

final class Client
{
    public function __construct(private readonly Transporter $transporter)
    {
    }

    public function chat(): Chat
    {
        return new Chat($this->transporter);
    }
}
