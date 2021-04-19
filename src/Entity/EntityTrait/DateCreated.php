<?php
declare(strict_types=1);
/**
 * Description:
 * hold the property dateCreated as it is almost identical in the most of the entities
 *
 * @package App\Entity\EntityTrait
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity\EntityTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait DateCreated
 *
 * @package App\Entity\EntityTrait
 */
trait DateCreated
{
    /**
     * @ORM\Column(type="datetime", name="date_created")
     */
    private $dateCreated;

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @ORM\PrePersist()
     * @return self
     * @throws \Exception
     */
    public function setDateCreated(): self
    {
        $this->dateCreated = new \DateTime();

        return $this;
    }
}

