<?php

namespace App\Service;

use App\Factory\ClientFactory;

class PackagingCalculationService
{
    private const VERTICAL_ROTATION = 1;

    private ClientFactory $clientFactory;

    private string $username;

    private string $apiKey;

    public function __construct(ClientFactory $clientFactory, string $username, string $apiKey)
    {
        $this->clientFactory = $clientFactory;
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * @param ProductDTO[] $list
     */
    public function sendRequest(array $list): int
    {
        $client = $this->clientFactory->get3dPackagestClient();
        try {
            $response = $client->request(
                'POST',
                '/packer/pack',
                [
                    'body' => json_encode($this->buildRequest($list)),
                ]
            );

            if ($response->getStatusCode() === 200 &&
               isset($body = $response->getBody())
            ) {
                echo "OK";
                //@todo LoggerInterface
            }

            echo $response->getStatusCode();
            echo $response->getBody();
        } catch (\Exception $e) {
            //@todo
        }
    }

    /**
     * In symfony can use Symfony/Normlaizer and hold all in object
     */
    private function buildRequest($list): array
    {
        return [
            'bins' => $this->buildDataBins(),
            'items' => $this->buildDataItems($list),
            'username' => $this->username,
            'api_key' => $this->apiKey,
            'params' => $this->buildDataParams(),
        ];
    }

    /**
     * In symfony can use Symfony/Normlaizer and hold all in object
     */
    private function buildDataItems($list): array
    {
        $items = [];
        foreach ($list as $key => $item) {
            $items[] = [
                'id' => $key,
                'w' => $item->x,
                'h' => $item->y,
                'd' => $item->z,
                'wg' => $item->weight,
                'q' => $item->quantity,
                'vr' => self::VERTICAL_ROTATION,
            ];
        }

        return $items;
    }

    /**
     * This substring can by cached || build in build
     * @todo use from entityManager
     */
    private function buildDataBins(): array
    {
        $bins = [
            [
                'id' => 'Pack M',
                'h' => '4',
                'w' => '4',
                'd' => '4',
                'wg' => '',
                'max_wg' => '',
            ],
            [
                'id' => 'Pack S',
                'h' => '3',
                'w' => '3',
                'd' => '6',
                'wg' => '',
                'max_wg' => '',
            ],
        ];
        return $bins;
    }

    private function buildDataParams(): array
    {
        return [];
    }
}
