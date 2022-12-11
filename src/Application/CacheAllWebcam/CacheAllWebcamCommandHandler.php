<?php

declare(strict_types=1);

namespace App\Application\CacheAllWebcam;


use App\Domain\Entity\Webcam;
use App\Domain\Repository\WebcamRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Serializer;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;


class CacheAllWebcamCommandHandler implements CommandHandler
{

    public function __construct(
        private HttpClientInterface $client,
        private WebcamRepository $repository,
        private Serializer $serializer,
        private LoggerInterface $logger,
        private \DateTime $lastUpdate = new \DateTime()
    ) {}


    public function __invoke(CacheAllWebcamCommand $command){
        try {
            $response = $this->client->request($_ENV["METHOD_API_MARCABLANCA"], $_ENV["URL_API_MARCABLANCA"]);

            $this->saveWebcamsOrFails($response);
            $this->removeUnupdatedWebcamsOrFails();

        } catch (TransportExceptionInterface $e) {
            $this->logger->critical("Unable to connect to {$_ENV["URL_API_MARCABLANCA"]} to retrieve webcams");
            throw $e;
        }
    }


    private function removeUnupdatedWebcamsOrFails()
    {
        $this->repository->removeUnusedWebcams($this->lastUpdate);
    }


    private function saveWebcamsOrFails(ResponseInterface $response)
    {
        foreach (@json_decode($response->getContent(false)) ?? [] as $webcam){

            $object = ($this->repository->findById((int)$webcam->wbmerId) ?? new Webcam())
                ->setWebcamPosition($i = isset($i) ? $i + 1 : 0)
                ->setLastUpdate($this->lastUpdate)
            ;

            $this->serializer->deserialize($webcam, $object);

            $this->repository->save($object);
        }
    }
}