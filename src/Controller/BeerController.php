<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Domains\Beers\Application\GetList;
use App\Domains\Beers\Application\Search;
use App\Domains\Beers\Infrastructure\BeerRepositoryPunkApi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Beer controller.
 * @Route("/api", name="api_")
 */

class BeerController extends AbstractFOSRestController
{
    /**
     * Lists all Beers by food
     * @Rest\Get("/beers/{food}")
     *
     * @param Request $request
     * @return Response
     */
    public function getBeersByFoodAction(Request $request)
    {
        $food = $request->get('food');

        $apiRepository = new BeerRepositoryPunkApi();
        $beerByFood = new Search($apiRepository);
        $content = $beerByFood($food);

        return $this->handleView($this->view($content));
    }

    /**
     * Get Beer detail
     * @Rest\Get("/beer/list/{id}")
     *
     * @param Request $request
     * @return Response
     */
    public function getBeerDetailAction(Request $request)
    {
        $id = $request->get('id');

        $apiRepository = new BeerRepositoryPunkApi();
        $beerDetail = new GetList($apiRepository);
        $content = $beerDetail($id);

        return $this->handleView($this->view($content));
    }
}