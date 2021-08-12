<?php
declare(strict_types=1);

namespace App\Controller;

use App\Client\Contract\PublicAPIClientContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DefaultController extends AbstractController
{
    public function __invoke(PublicAPIClientContract $client): Response
    {
        $entry = $client->random('Cat');

        return new JsonResponse(['title' => $entry->getAttribute('API')]);
    }
}
