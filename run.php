<?php

use App\Application;
use App\Decoder\ProductDecoder;
use App\Facade\PackagingCalculationFacade;
use App\Factory\ClientFactory;
use App\Service\PackagingCalculationService;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;

/** @var EntityManager $entityManager */
$entityManager = require __DIR__ . '/src/bootstrap.php';

$productDecoder =  new ProductDecoder();
$packageCalculationFacade = new PackagingCalculationFacade($productDecoder);

$clientFactory = new ClientFactory();
$username = 'jiri.florian@chro.cz';
$apiKey = '38cdc6f924192af57287ee7218e45f97';


$packagingCalculationService = new PackagingCalculationService($clientFactory, $username, $apiKey);




$request = new Request('POST', new Uri('http://localhost/pack'), ['Content-Type' => 'application/json'], $argv[1]);

$application = new Application($entityManager, $packageCalculationFacade, $packagingCalculationService);
$response = $application->run($request);

echo "<<< In:\n" . Message::toString($request) . "\n\n";
echo ">>> Out:\n" . Message::toString($response) . "\n\n";
