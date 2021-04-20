<?php
declare(strict_types=1);
/**
 * Description:
 * holds common functionalities used by the services
 *
 * @package App\Service
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ServiceBase
 *
 * @package App\Service
 */
class ServiceBase
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * ServiceBase constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
