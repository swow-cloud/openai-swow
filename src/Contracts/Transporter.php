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

use JsonException;
use SwowCloud\OpenAI\Exceptions\ErrorException;
use SwowCloud\OpenAI\Exceptions\TransporterException;
use SwowCloud\OpenAI\Exceptions\UnserializableResponse;
use SwowCloud\OpenAI\Objects\Transporter\Payload;

interface Transporter
{
    /**
     * @return array<array-key,mixed>
     * @throws ErrorException|UnserializableResponse|TransporterException|JsonException
     */
    public function request(Payload $payload): array|string;
}
