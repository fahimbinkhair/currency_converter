<?php
declare(strict_types=1);
/**
 * Description:
 * This controller is used for handling remit transfer activities
 *
 * @package App\Controller
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Controller;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MoneyTransferController
 *
 * @package App\Controller
 */
class MoneyTransferController extends AbstractController
{
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * MoneyTransferController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/transfer/supported-currencies", name="getCurrencies")
     */
    public function getCurrencies(): Response
    {
        try {
            /** @var CurrencyRepository $currencyRepository */
            $currencyRepository = $this->em->getRepository(Currency::class);
            /** @var array $currencies */
            $currencies = $currencyRepository->getCurrencies();

            return $this->json($currencies);
        } catch (\Throwable $throwable) {
            syslog(LOG_ERR, "{$throwable->getFile()} ({$throwable->getLine()}): {$throwable->getMessage()}");
            throw $this->createNotFoundException('Can not get currency');
        }
    }

    /**
     * @Route("/transfer/exchange-rate", name="getExchangeRate")
     */
    public function getExchangeRate(): Response
    {
        return $this->json([]);
    }
}
