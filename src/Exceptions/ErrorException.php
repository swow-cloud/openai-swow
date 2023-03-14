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

namespace SwowCloud\OpenAI\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param array{message: string, type: string, code: string} $contents
     */
    public function __construct(private readonly array $contents)
    {
        parent::__construct($contents['message']);
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): string
    {
        return $this->contents['type'];
    }

    /**
     * Returns the error type.
     */
    public function getErrorCode(): string
    {
        return $this->contents['code'];
    }
}
