<?php


namespace App\Tests\UnitTest\CacheAllWebcam;


use App\Application\CacheAllWebcam\CacheAllWebcamCommand;
use App\Application\CacheAllWebcam\CacheAllWebcamCommandHandler;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CacheAllWebcamApiTransportExceptionCommandHandlerTest extends KernelTestCase
{
    private $handler;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->handler = new CacheAllWebcamCommandHandler(
            $this->getClientMock(),
            $container->get("App\Domain\Repository\WebcamRepository"),
            $container->get("App\Shared\Domain\Serializer"),
            $container->get("Psr\Log\LoggerInterface"),
            new \DateTime()
        );
    }

    public function testCheckCacheIfApiFails()
    {
        $this->expectException(TransportExceptionInterface::class);

        $this->handler->__invoke(new CacheAllWebcamCommand());
    }

    private function getClientMock(): HttpClientInterface|MockObject
    {
        $clientMock = $this->createMock(HttpClientInterface::class);
        $clientMock->expects(self::once())->method("request")->willThrowException(new TransportException());

        return $clientMock;
    }

}//class