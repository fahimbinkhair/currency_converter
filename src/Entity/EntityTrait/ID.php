<?php
declare(strict_types=1);
/**
 * Description:
 * hold the property id as it is identical in every entity
 *
 * @package App\Entity\EntityTrait
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity\EntityTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ID
 *
 * @package App\Entity\EntityTrait
 */
trait ID
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
