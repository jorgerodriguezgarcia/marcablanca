<?php


namespace App\Tests\UnitTest\CacheAllWebcam;


use App\Application\CacheAllWebcam\CacheAllWebcamCommand;
use App\Application\CacheAllWebcam\CacheAllWebcamCommandHandler;
use App\Domain\Repository\WebcamRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

class CacheAllWebcamApiResponseIsEmptyCommandHandlerTest extends KernelTestCase
{
    private $handler;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->handler = new CacheAllWebcamCommandHandler(
            $this->getHttpClientAnonymousFunction(),
            $container->get("App\Domain\Repository\WebcamRepository"),
            $container->get("App\Shared\Domain\Serializer"),
            $container->get("Psr\Log\LoggerInterface"),
            new \DateTime()
        );

        $this->repository = $container->get(WebcamRepository::class);
    }

    public function testCheckCacheIfApiIsEmpty()
    {
        $this->handler->__invoke(new CacheAllWebcamCommand());
        $webcams = $this->repository->searchAll();

        $this->assertCount(0, $webcams);
    }

    private function getHttpClientAnonymousFunction()
    {
        return new class implements HttpClientInterface
        {
            public function request(string $method, string $url, array $options = []): ResponseInterface
            {
                return new class implements ResponseInterface
                {
                    public function getStatusCode(): int
                    {
                        return 200;
                    }

                    public function getHeaders(bool $throw = true): array
                    {
                        return [];
                    }

                    public function getContent(bool $throw = true): string
                    {
                        return json_encode(null);
                    }

                    public function toArray(bool $throw = true): array
                    {
                        return [];
                    }

                    public function cancel(): void { }


                    public function getInfo(string $type = null): mixed { }
                };
            }

            public function stream($responses, float $timeout = null): ResponseStreamInterface { }

            public function __call(string $name, array $arguments) { }
        };
    }


}//class