<?php

declare(strict_types = 1);

namespace App\Domains\Beers\Domain;

interface BeerRepository
{
    public function getBeersByFood($food);

    public function getBeerDetail($id);
}

