<?php


namespace App\Domain\Entity;


class Member
{
    private $id;
    private $name;
    private $websiteName;
    private $websiteUrl;
    private $natsTrackingCodeForWebcams;
    private $natsTrackingCodeForMainPage;
    private $pathToCssDirectory;
    private $googleAnalyticsIdentifier;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWebsiteName(): ?string
    {
        return $this->websiteName;
    }

    public function setWebsiteName(?string $websiteName): self
    {
        $this->websiteName = $websiteName;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getNatsTrackingCodeForWebcams(): ?string
    {
        return $this->natsTrackingCodeForWebcams;
    }

    public function setNatsTrackingCodeForWebcams(?string $natsTrackingCodeForWebcams): self
    {
        $this->natsTrackingCodeForWebcams = $natsTrackingCodeForWebcams;

        return $this;
    }

    public function getNatsTrackingCodeForMainPage(): ?string
    {
        return $this->natsTrackingCodeForMainPage;
    }

    public function setNatsTrackingCodeForMainPage(?string $natsTrackingCodeForMainPage): self
    {
        $this->natsTrackingCodeForMainPage = $natsTrackingCodeForMainPage;

        return $this;
    }

    public function getPathToCssDirectory(): ?string
    {
        return $this->pathToCssDirectory;
    }

    public function setPathToCssDirectory(?string $pathToCssDirectory): self
    {
        $this->pathToCssDirectory = $pathToCssDirectory;

        return $this;
    }

    public function getGoogleAnalyticsIdentifier(): ?string
    {
        return $this->googleAnalyticsIdentifier;
    }

    public function setGoogleAnalyticsIdentifier(?string $googleAnalyticsIdentifier): self
    {
        $this->googleAnalyticsIdentifier = $googleAnalyticsIdentifier;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}//class