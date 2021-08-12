<?php
declare(strict_types=1);

namespace App\Event;

use EonX\EasyHttpClient\Data\RequestData;
use EonX\EasyHttpClient\Data\ResponseData;

final class PublicAPIRequestEvent
{
    private RequestData $requestData;

    private ResponseData $responseData;

    public function __construct(RequestData $requestData, ResponseData $responseData)
    {
        $this->requestData = $requestData;
        $this->responseData = $responseData;
    }

    public function getRequestData(): RequestData
    {
        return $this->requestData;
    }

    public function getResponseData(): ResponseData
    {
        return $this->responseData;
    }
}
