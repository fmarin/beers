<?php

declare(strict_types = 1);

namespace App\Domains\Beers\Infrastructure;

use App\Domains\Beers\Domain\BeerRepository;
use Symfony\Component\HttpClient\HttpClient;

class BeerRepositoryPunkApi implements BeerRepository
{
    private $client;
    private $url;

    public function __construct()
    {
        $this->client = HttpClient::create();
        $this->url = 'https://api.punkapi.com/v2/beers';
    }

    public function search($food)
    {
        $response = $this->client->request('GET', $this->url, [
            'query' => [
                'food' => $food
            ],
        ]);

        return $this->checkResponse($response);
    }

    public function getList($id)
    {
        $response = $this->client->request('GET', $this->url, [
            'query' => [
                'ids' => $id
            ],
        ]);

        return $this->checkResponse($response);
    }

    private function checkResponse($response){
        $data = ['success' => false];

        $statusCode = $response->getStatusCode();

        if($statusCode == 200){
            $data['success'] = true;
            $data['beers'] = $response->toArray();
        }

        return $data;
    }
}