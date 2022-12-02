<?php

namespace Yandex\Marketplace\Partner\Clients;

use Yandex\Marketplace\Partner\Models\Response\PostResponse;
use Yandex\Marketplace\Partner\Models\Response\StocksResponse;

class StocksClient extends Client
{
    /**
     * Requests information stocks
     *
     * @see https://yandex.ru/dev/market/partner-marketplace-cd/doc/dg/reference/post-stocks-docpage/
     *
     * @param $response
     * @return StocksResponse
     */
    public function getStocks($response)
    {
        $decodedResponseBody = $this->getDecodedBody($response);

        return new StocksResponse($decodedResponseBody);
    }

        /**
     * @param $campaignId
     * @param array $params
     * @param null $dbgKey
     * @return PostResponse
     * @throws \Yandex\Marketplace\Partner\Exception\PartnerRequestException
     */
    public function updateStocks($campaignId, array $params = [], $dbgKey = null)
    {
        $resource = 'campaigns/' . $campaignId . '/offers/stocks.json';
        $resource = $this->addDebugKey($resource, $dbgKey);
        $response = $this->sendRequest(
            'PUT',
            $this->getServiceUrl($resource),
            ['json' => $params]
        );
        $decodedResponseBody = $this->getDecodedBody($response->getBody());

        return new PostResponse($decodedResponseBody);
    }
}
