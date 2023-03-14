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

namespace SwowCloud\OpenAI\Enum;

enum ApiMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
