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

namespace SwowCloud\OpenAI\Resources;

use JsonException;
use SwowCloud\OpenAI\Exceptions\ErrorException;
use SwowCloud\OpenAI\Exceptions\TransporterException;
use SwowCloud\OpenAI\Exceptions\UnserializableResponse;
use SwowCloud\OpenAI\Objects\Transporter\Payload;
use SwowCloud\OpenAI\Resources\Concerns\Transportable;
use SwowCloud\OpenAI\Responses\Models\DeleteResponse;
use SwowCloud\OpenAI\Responses\Models\ListResponse;
use SwowCloud\OpenAI\Responses\Models\RetrieveResponse;

final class Models
{
    use Transportable;

    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @see https://beta.openai.com/docs/api-reference/models/list
     */
    public function list(): ListResponse
    {
        $payload = Payload::list('models');

        /** @var array{object: string, data: array<int, array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>} $result */
        $result = $this->transporter->request($payload);

        return ListResponse::from($result);
    }

    public function retrieve(string $model): RetrieveResponse
    {
        $payload = Payload::retrieve('models', $model);

        /** @var array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string} $result */
        $result = $this->transporter->request($payload);

        return RetrieveResponse::from($result);
    }

    /**
     * @throws JsonException
     * @throws ErrorException
     * @throws TransporterException
     * @throws UnserializableResponse
     */
    public function delete(string $model): DeleteResponse
    {
        $payload = Payload::delete('models', $model);

        /** @var array{id: string, object: string, deleted: bool} $result */
        $result = $this->transporter->request($payload);

        return DeleteResponse::from($result);
    }
}
