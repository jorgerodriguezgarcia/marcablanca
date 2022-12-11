<?php


namespace App\Infraestructure\Controller;

use App\Application\SearchMemberByUrlAndAllWebcams\SearchMemberByUrlAndAllWebcamsQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class HomePage
{
    public function __construct(
        private QueryBus $queryBus,
        private Environment $environment,
        private RequestStack $requestStack,
        private ErrorControllerHandler $errorControllerHandler
    ) { }

    public function __invoke()
    {
        try {
            $request = $this->requestStack->getCurrentRequest();

            $responseQuery = $this->queryBus->ask(new SearchMemberByUrlAndAllWebcamsQuery($request->getHttpHost()));

            return (new Response(
                $this->environment->render(
                    "homepage.html.twig",
                    [
                        "member" => $responseQuery->getMember(),
                        "smallThumbs" => array_slice($responseQuery->getWebcam(), 1),
                        "bigThumbs" => array_slice($responseQuery->getWebcam(), 0, 5),
                        "urlImage" => $_ENV["URL_PHOTO_MARCABLANCA"]
                    ]
                ), 200
            ))
                ->setPublic()
                ->setMaxAge($_ENV['CACHE_EXPIRE'])
                ->setSharedMaxAge($_ENV['CACHE_EXPIRE'])
                ->setLastModified(new \DateTime());
        }
        catch (\Throwable $e){
            return $this->errorControllerHandler->__invoke($e);
        }
    }

}//class