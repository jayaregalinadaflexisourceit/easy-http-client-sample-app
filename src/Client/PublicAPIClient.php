<?php
declare(strict_types=1);

namespace App\Client;

use App\Client\Contract\PublicAPIClientContract;
use App\Model\PublicAPIEntry;
use App\Subscriber\PublicAPISubscriber;
use EonX\EasyHttpClient\Interfaces\HttpOptionsInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class PublicAPIClient implements PublicAPIClientContract
{
    private string $baseUri;

    private HttpClientInterface $client;

    private PublicAPISubscriber $subscriber;

    public function __construct(HttpClientInterface $client, PublicAPISubscriber $subscriber, string $baseUri)
    {
        $this->client = $client;
        $this->subscriber = $subscriber;
        $this->baseUri = $baseUri;
    }

    public function random(?string $title = null): PublicAPIEntry
    {
        $response = $this->request('random', $title !== null ? \compact('title') : null);

        return new PublicAPIEntry($response->toArray()['entries'][0] ?? []);
    }

    private function request(string $path, ?array $body = null, ?string $method = null): ResponseInterface
    {
        $options = [
            'base_uri' => $this->baseUri,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'query' => $body ?? [],
            HttpOptionsInterface::REQUEST_DATA_SUBSCRIBERS => [$this->subscriber],
        ];

        return $this->client->request($method ?? Request::METHOD_GET, $path, $options);
    }
}
