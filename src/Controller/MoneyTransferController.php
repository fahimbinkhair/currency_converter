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
use App\Service\Model\ExchangeRateModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MoneyTransferController
 *
 * @package App\Controller
 */
class MoneyTransferController extends BaseController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        /** @var CurrencyRepository $currencyRepository */
        $currencyRepository = $this->em->getRepository(Currency::class);
        /** @var array $currencies */
        $currencies = $currencyRepository->getCurrencies();
        /** @var string $route */
        $route = $this->get('router')->generate('getExchangeRate', array(), false);

        return $this->render('MoneyTransfer/home.html.twig', ['currencies' => $currencies, 'route' => $route]);
    }

    /**
     * @Route("/transfer/exchange-rate", name="getExchangeRate", methods={"get"})
     * @param Request $request
     * @param ExchangeRateModel $exchangeRateModel
     * @return Response
     * @throws \Exception
     */
    public function getExchangeRate(Request $request, ExchangeRateModel $exchangeRateModel): Response
    {
        try {
            /** @var int $fromCurrency */
            $fromCurrency = (int)$request->get('fromCurrency', 0);
            /** @var int $toCurrency */
            $toCurrency = (int)$request->get('toCurrency', 0);
            /** @var float $sourceAmount */
            $sourceAmount = (float)$request->get('sourceAmount', '0.00');
            /** @var float $destinationAmount */
            $destinationAmount = $exchangeRateModel
                ->setRate($fromCurrency, $toCurrency)
                ->getDestinationAmount($sourceAmount);

            return $this->json([
                'destinationAmount' => $destinationAmount,
                'exchangeRate' => $exchangeRateModel->getRate()
            ]);
        } catch (\Throwable $throwable) {
            throw $this->createNotFoundException('Can not calculate destination amount');
        }
    }
}
