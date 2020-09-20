<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $data = [];

    /**
     * @ORM\OneToOne(targetEntity=GoogleCache::class, cascade={"persist", "remove"}, inversedBy="statistics")
     * @ORM\JoinColumn(name="google_cache_id", referencedColumnName="id", nullable=false)
     */
    private $google_cache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getGoogleCache(): ?GoogleCache
    {
        return $this->google_cache;
    }

    public function setGoogleCache(GoogleCache $google_cache): self
    {
        $this->google_cache = $google_cache;

        return $this;
    }
}
