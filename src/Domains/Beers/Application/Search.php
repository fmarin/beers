<?php

declare(strict_types = 1);

namespace App\Domains\Beers\Application;

use App\Domains\Beers\Domain\BeerRepository;

class Search
{
    private $repository;
    private $outputFields = [
        'id',
        'name',
        'description'
    ];

    public function __construct(BeerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($food)
    {
        $content = [];
        $data = $this->repository->search($food);

        if($data['success']){
            $beers = $data['beers'];

            foreach($beers as $beer){
                $content[] = array_intersect_key($beer, array_flip($this->outputFields));
            }
        }

        return $content;
    }
}