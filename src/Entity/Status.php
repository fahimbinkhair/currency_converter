<?php
declare(strict_types=1);
/**
 * Description:
 * holds all supported record status
 *
 * @package App\Entity
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity;

use App\Entity\EntityTrait\ID;
use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * Add the property id along with its getter
     */
    use ID;

    /** @var int[] */
    public const STATUS = [
        //statusName => id, need migration if you modify this array
        'active' => 1,
        'inactive' => 2,
        'deleted' => 3
    ];

    /**
     * @ORM\Column(name="name", type="string", length=15, unique=true)
     */
    private $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
