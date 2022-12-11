<?php


namespace App\Tests\IntegrationTest\Persistence;


use App\Domain\Entity\Webcam;
use App\Infraestructure\Persistence\MysqlWebcamRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckMysqlWebcamRepositoriyTest extends KernelTestCase
{
    private  $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->repository = $container->get(MysqlWebcamRepository::class);
    }

    public function testCheckMysqlWebcamRepositoryIsUp()
    {
        $webcam = $this->repository->findById(999999);

        $this->assertSame(999999, $webcam->getId());
    }

    public function testCheckMysqlWebcamRepositorySearchAll()
    {
        $webcams = $this->repository->searchAll();

        $this->assertCount(2, $webcams);

        for ($i=1; $i<count($webcams); $i++){
            $this->assertGreaterThan(
                array_values($webcams)[$i-1]?->getWebcamPosition(),
                array_values($webcams)[$i]?->getWebcamPosition()
            );
        }
    }

    public function testCheckMysqlRepositorySave()
    {
        $this->repository->save(
            (new Webcam())->setId(999995)->setNick("Test")->setWebcamPosition("999995")
        );

        $webcam = $this->repository->findById("999995");

        $this->assertNotNull($webcam);
    }

    public function testCheckMysqlRepositoryDelete()
    {
        $this->repository->delete($this->repository->findById("999999"));

        $webcam = $this->repository->findById("999999");

        $this->assertNull($webcam);
    }

    public function testCheckMysqlRepositoryDeleteUnused()
    {
        $webcam = $this->repository->findById("999999");

        $this->repository->removeUnusedWebcams($webcam->getLastUpdate());
        $webcam = $this->repository->searchAll();
        $this->assertCount(2, $webcam);

        $this->repository->removeUnusedWebcams(new \DateTime());
        $webcam = $this->repository->searchAll();
        $this->assertCount(0, $webcam);
    }

}//class