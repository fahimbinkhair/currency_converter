<?php
declare(strict_types=1);
/**
 * Description:
 * hold the property status_id as it is almost identical in the most of the entities
 *
 * @package App\Entity\EntityTrait
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity\EntityTrait;

use App\Entity\Status;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\EventArgs;

/**
 * Trait Status
 *
 * @package App\Entity\EntityTrait
 */
trait StatusId
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")
     * @ORM\JoinColumn(name="status_id", nullable=false)
     */
    private $status;

    /**
     * @return Status|null
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @ORM\PreFlush()
     * @param EventArgs $eventArgs
     */
    public function getStatusReference(EventArgs $eventArgs)
    {
        if (!$this->status instanceof Status) {
            $entityManager = $eventArgs->getEntityManager();
            $this->status = $entityManager->getReference(Status::class, $this->status);
        }
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
