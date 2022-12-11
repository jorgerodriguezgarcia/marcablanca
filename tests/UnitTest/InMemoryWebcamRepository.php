<?php


namespace App\Tests\UnitTest;


use App\Domain\Entity\Webcam;
use App\Domain\Repository\WebcamRepository;

class InMemoryWebcamRepository implements WebcamRepository
{
    private $webcams;

    public function __construct()
    {
       $this->webcams = [
           (new Webcam())->setId(999999)->setNick("Girl 1")->setPermalink("girl_1")->setWebcamPosition("0"),
           (new Webcam())->setId(999998)->setNick("Girl 2")->setPermalink("girl_2")->setWebcamPosition("1"),
        ];
    }

    public function save(Webcam $webcam): void {
        foreach ($this->webcams??[] as $k=>$w){
            if ($w->getId()===$webcam->getId()) {
                $this->webcams[$k] = $webcam;
                return;
            }
        }
        $this->webcams[]=$webcam;
    }

    public function delete(Webcam $webcam): void {
        foreach ($this->webcams??[] as $k=>$w){
            if ($w->getId()===$webcam->getId()) {
                unset($this->webcams[$k]);
                return;
            }
        }
    }

    public function searchAll(): array
    {
        return $this->sortWebcams($this->webcams);
    }

    public function findById(int $id): ?Webcam
    {
        return @array_values(@array_filter ($this->webcams, fn($w)=>($w->getId()==$id)))[0];
    }

    public function removeUnusedWebcams(\DateTimeInterface $lastUpdate): void
    {
        foreach ($this->webcams??[] as $k=>$w){
            if ($w->getLastUpdate()!==$lastUpdate) {
                unset($this->webcams[$k]);
            }
        }
    }

    private function sortWebcams(array $webcams):array{
        usort ($webcams,

        function ($a, $b){
            if ($a->getWebcamPosition() == $b->getWebcamPosition()) return 0;
            return ($a->getWebcamPosition() < $b->getWebcamPosition()) ? -1 : 1;
        });

        return $webcams;
    }

}//class