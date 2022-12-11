<?php


namespace App\Infraestructure\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ModalWebcam
{
    public function __construct(
        private HttpClientInterface $client,
        private ErrorControllerHandler $errorControllerHandler
    )
    {}

    public function __invoke($permalink)
    {
        try {
            $request = $this->client->request(
                $_ENV['METHOD_JOINMB_MARCABLANCA'],
                $_ENV['URL_JOINMB_MARCABLANCA']."/{$permalink}"
            );

            return (new Response($request->getContent(), 200))
                ->setPublic()
                ->setMaxAge($_ENV['CACHE_EXPIRE'])
                ->setSharedMaxAge($_ENV['CACHE_EXPIRE'])
                ->setLastModified(new \DateTime())
            ;
        }
        catch (\Throwable $e){
            $this->errorControllerHandler->__invoke($e);
        }
    }
}//class