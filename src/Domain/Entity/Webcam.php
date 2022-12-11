<?php

namespace App\Domain\Entity;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\DBAL\Types\Types;


class Webcam extends AggregateRoot
{
    private ?string $twitter = null;

    private ?string $nick = null;

    private ?string $permalink = null;

    private ?bool $online = null;

    private ?\DateTimeInterface $birthdate = null;

    private ?float $height = null;

    private ?string $country = null;

    private ?int $system = null;

    private ?int $systemId = null;

    private ?string $thumb1 = null;

    private ?string $thumb2 = null;

    private ?string $thumb3 = null;

    private ?string $thumb4 = null;

    private ?bool $active = null;

    private ?bool $live = null;

    private ?bool $new = null;

    private ?\DateTimeInterface $banned = null;

    private ?int $ranking = null;

    private ?\DateTimeInterface $lastLogin = null;

    private ?\DateTimeInterface $register = null;

    private ?int $pHd = null;

    private ?int $pAudio = null;

    private ?float $dtRate = null;

    private ?string $espSwf = null;

    private ?string $videos = null;

    private ?float $positionOnline = null;

    private ?float $position = null;

    private ?int $soft = null;

    private ?string $languages = null;

    private ?int $id = null;

    private ?int $webcamPosition = null;

    private ?\DateTimeInterface $lastUpdate = null;

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    public function getPermalink(): ?string
    {
        return $this->permalink;
    }

    public function setPermalink(?string $permalink): self
    {
        $this->permalink = $permalink;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSystem(): ?int
    {
        return $this->system;
    }

    public function setSystem(?int $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function getSystemId(): ?int
    {
        return $this->systemId;
    }

    public function setSystemId(?int $systemId): self
    {
        $this->systemId = $systemId;

        return $this;
    }

    public function getThumb1(): ?string
    {
        return $this->thumb1;
    }

    public function setThumb1(?string $thumb1): self
    {
        $this->thumb1 = $thumb1;

        return $this;
    }

    public function getThumb2(): ?string
    {
        return $this->thumb2;
    }

    public function setThumb2(?string $thumb2): self
    {
        $this->thumb2 = $thumb2;

        return $this;
    }

    public function getThumb3(): ?string
    {
        return $this->thumb3;
    }

    public function setThumb3(?string $thumb3): self
    {
        $this->thumb3 = $thumb3;

        return $this;
    }

    public function getThumb4(): ?string
    {
        return $this->thumb4;
    }

    public function setThumb4(?string $thumb4): self
    {
        $this->thumb4 = $thumb4;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isLive(): ?bool
    {
        return $this->live;
    }

    public function setLive(?bool $live): self
    {
        $this->live = $live;

        return $this;
    }

    public function isNew(): ?bool
    {
        return $this->new;
    }

    public function setNew(?bool $new): self
    {
        $this->new = $new;

        return $this;
    }

    public function getBanned(): ?\DateTimeInterface
    {
        return $this->banned;
    }

    public function setBanned(?\DateTimeInterface $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setRanking(?int $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getRegister(): ?\DateTimeInterface
    {
        return $this->register;
    }

    public function setRegister(?\DateTimeInterface $register): self
    {
        $this->register = $register;

        return $this;
    }

    public function getPHd(): ?int
    {
        return $this->pHd;
    }

    public function setPHd(?int $pHd): self
    {
        $this->pHd = $pHd;

        return $this;
    }

    public function getPAudio(): ?int
    {
        return $this->pAudio;
    }

    public function setPAudio(?int $pAudio): self
    {
        $this->pAudio = $pAudio;

        return $this;
    }

    public function getDtRate(): ?float
    {
        return $this->dtRate;
    }

    public function setDtRate(?float $dtRate): self
    {
        $this->dtRate = $dtRate;

        return $this;
    }

    public function getEspSwf(): ?string
    {
        return $this->espSwf;
    }

    public function setEspSwf(?string $espSwf): self
    {
        $this->espSwf = $espSwf;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(?string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getPositionOnline(): ?float
    {
        return $this->positionOnline;
    }

    public function setPositionOnline(?float $positionOnline): self
    {
        $this->positionOnline = $positionOnline;

        return $this;
    }

    public function getPosition(): ?float
    {
        return $this->position;
    }

    public function setPosition(?float $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getSoft(): ?int
    {
        return $this->soft;
    }

    public function setSoft(?int $soft): self
    {
        $this->soft = $soft;

        return $this;
    }

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(?string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id=$id;

        return $this;
    }

    public function getWebcamPosition()
    {
        return $this->webcamPosition;
    }

    public function setWebcamPosition($webcamPosition): self
    {
        $this->webcamPosition = $webcamPosition;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(?\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
