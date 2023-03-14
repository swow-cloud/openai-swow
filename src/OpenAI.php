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

use Swow\Psr7\Client\Client as SwowHttpClient;
use SwowCloud\OpenAI\Const\Chat;
use SwowCloud\OpenAI\Objects\ApiKey;
use SwowCloud\OpenAI\Objects\Transporter\BaseUri;
use SwowCloud\OpenAI\Objects\Transporter\Headers;
use SwowCloud\OpenAI\Transporters\HttpTransporters;

final class OpenAI
{
    public static function client(string $apiKey, ?string $organization = null): Client
    {
        $apiKey = ApiKey::from($apiKey);
        $baseUri = BaseUri::from(Chat::BASE_URI);

        $headers = Headers::withAuthorization($apiKey);

        if ($organization !== null) {
            $headers->withOrganization($organization);
        }

        $client = (new SwowHttpClient())
            ->connect($baseUri->toString(), Chat::PORT)
            // https://www.php.net/manual/zh/context.ssl.php 跳过验证证书
            ->enableCrypto([
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]);

        $transporter = new HttpTransporters($client, $baseUri, $headers);

        return new Client($transporter);
    }
}
