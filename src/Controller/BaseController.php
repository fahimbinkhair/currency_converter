<?php
declare(strict_types=1);
/**
 * Description:
 * holds common functionalities used by the controllers
 *
 * @package App\Controller
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BaseController
 *
 * @package App\Controller
 */
class BaseController extends AbstractController
{
    /** @var EntityManagerInterface $em */
    protected $em;

    /**
     * MoneyTransferController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
}
