<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\HasLifecycleCallbacks()
 */
trait CreatedAtTrait
{
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): void {
        $this->createdAt = new \DateTime();
    }
}