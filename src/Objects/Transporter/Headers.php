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

use SwowCloud\OpenAI\Const\Header;
use SwowCloud\OpenAI\Enum\ApiContentType;
use SwowCloud\OpenAI\Objects\ApiKey;

final class Headers
{
    /**
     * @param array<string,string> $headers
     */
    private function __construct(private readonly array $headers)
    {
    }

    public static function withAuthorization(ApiKey $apiKey): self
    {
        return new self([
            Header::AUTHORIZATION => sprintf('Bearer %s', $apiKey->toString()),
        ]);
    }

    /**
     * @return $this
     */
    public function withContentType(ApiContentType $contentType, string $suffix = ''): self
    {
        return new self([
            ...$this->headers,
            'Content-Type' => $contentType->value . $suffix,
        ]);
    }

    /**
     * @return $this
     */
    public function withOrganization(string $organization): self
    {
        return new self([
            ...$this->headers,
            'OpenAI-Organization' => $organization,
        ]);
    }

    /**
     * @return array<string, string> $headers
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
