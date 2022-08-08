<?php

namespace App;

use App\Facade\PackagingCalculationFacade;
use App\Service\PackagingCalculationService;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Application
{
    private EntityManager $entityManager;

    private PackagingCalculationFacade $packageCalculationFacade;

    private PackagingCalculationService $packageCalculationService;

    public function __construct(
        EntityManager $entityManager,
        PackagingCalculationFacade $packageCalculationFacade,
        PackagingCalculationService $packageCalculationService
    ) {
        $this->entityManager = $entityManager;
        $this->packageCalculationFacade = $packageCalculationFacade;
        $this->packageCalculationService = $packageCalculationService;
    }

    public function run(RequestInterface $request): ResponseInterface
    {
        $list = $this->packageCalculationFacade->run($request->getBody());
        $this->packageCalculationService->sendRequest($list);
        // your implementation entrypoint
        return new Response();
    }
}
