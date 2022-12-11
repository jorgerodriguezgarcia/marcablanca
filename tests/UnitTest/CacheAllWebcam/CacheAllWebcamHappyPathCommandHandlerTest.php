<?php


namespace App\Tests\UnitTest\CacheAllWebcam;


use App\Application\CacheAllWebcam\CacheAllWebcamCommand;
use App\Application\CacheAllWebcam\CacheAllWebcamCommandHandler;
use App\Domain\Repository\WebcamRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CacheAllWebcamHappyPathCommandHandlerTest extends KernelTestCase
{
    private $handler;
    private $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->handler = $container->get(CacheAllWebcamCommandHandler::class);
        $this->repository = $container->get(WebcamRepository::class);
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

        $this->assertSame("eva-madrid", $this->repository->findById(6723)->getPermalink());
    }

}//class