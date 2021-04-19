<?php
declare(strict_types=1);
/**
 * Description:
 * hold the property dateUpdated as it is almost identical in the most of the entities
 *
 * @package App\Entity\EntityTrait
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity\EntityTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait DateUpdated
 *
 * @package App\Entity\EntityTrait
 */
trait DateUpdated
{
    /**
     * @ORM\Column(type="datetime", nullable=true, name="date_updated")
     */
    private $dateUpdated;

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    /**
     * @ORM\PreUpdate()
     * @return self
     * @throws \Exception
     */
    public function setDateUpdated(): self
    {
        $this->dateUpdated = new \DateTime();

        return $this;
    }
}

