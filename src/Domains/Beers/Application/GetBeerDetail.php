<?php

declare(strict_types = 1);

namespace App\Domains\Beers\Application;

use App\Domains\Beers\Domain\BeerRepository;

class GetBeerDetail
{
    private $repository;
    private $outputFields = [
        'id',
        'name',
        'description',
        'image_url',
        'tagline',
        'first_brewed'
    ];

    public function __construct(BeerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $content = [];
        $data = $this->repository->getBeerDetail($id);

        if($data['success']){
            $beer = $data['beers'][0];
            $content[] = array_intersect_key($beer, array_flip($this->outputFields));
        }

        return $content;
    }
}