<?php


namespace App\Tests\IntegrationTest\CacheAllWebcam;


use App\Application\CacheAllWebcam\CacheAllWebcamCommand;
use App\Application\CacheAllWebcam\CacheAllWebcamCommandHandler;
use App\Infraestructure\Persistence\MysqlWebcamRepository;
use App\Shared\Infrastructure\Serializer\Serializer;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\NativeHttpClient;


class CacheAllWebcamHappyPathCommandHandlerTest extends KernelTestCase
{
    private $handler;
    private $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->handler = $container->get(CacheAllWebcamCommandHandler::class);
        $this->repository = $container->get(MysqlWebcamRepository::class);

        $this->handler = new CacheAllWebcamCommandHandler(
            new NativeHttpClient(),
            $this->repository,
            $container->get(Serializer::class),
            $container->get(LoggerInterface::class),
            new \DateTime()
        );
    }

    public function testCheckCacheAfterSyncWebcams()
    {
        $this->assertNotNull($this->repository->findById(999999));

        $this->handler->__invoke(new CacheAllWebcamCommand());
        $webcams = $this->repository->searchAll();

        $this->assertCount(61, $webcams);

        for ($i=1; $i<count($webcams); $i++){
            $this->assertGreaterThan(
                array_values($webcams)[$i-1]?->getWebcamPosition(),
                array_values($webcams)[$i]?->getWebcamPosition()
            );
        }

        $this->assertNull($this->repository->findById(999999));

    }
}//class