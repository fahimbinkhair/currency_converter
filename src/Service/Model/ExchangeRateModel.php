<?php
declare(strict_types=1);
/**
 * Description:
 * holds business logics related with the entity ExchangeRate
 *
 * @package App\Service\Model
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Service\Model;

use App\Entity\Currency;
use App\Entity\ExchangeRate;
use App\Repository\ExchangeRateRepository;
use App\Service\ServiceBase;

/**
 * Class ExchangeRateModel
 *
 * @package App\Service\Model
 */
class ExchangeRateModel extends ServiceBase
{
    /** @var string $rate */
    private $rate = '0.00';

    /**
     * @param int $fromCurrency
     * @param int $toCurrency
     * @return $this
     * @throws \Exception
     */
    public function setRate(int $fromCurrency, int $toCurrency): self
    {
        /** @var ExchangeRateRepository $exchangeRateRepository */
        $exchangeRateRepository = $this->em->getRepository(ExchangeRate::class);
        /** @var Currency $fromCurrency */
        $fromCurrency = $this->em->getReference(Currency::class, $fromCurrency);
        /** @var Currency $toCurrency */
        $toCurrency = $this->em->getReference(Currency::class, $toCurrency);
        /** @var ExchangeRate $exchangeRate */
        $exchangeRate = $exchangeRateRepository->findOneBy([
            'fromCurrency' => $fromCurrency,
            'toCurrency' => $toCurrency
        ]);

        if (!$exchangeRate instanceof ExchangeRate) {
            throw new \Exception('Can not find the exchange rate');
        }

        $this->rate = $exchangeRate->getRate();

        return $this;
    }

    /**
     * @return string
     */
    public function getRate(): string
    {
        return number_format((float)$this->rate, 2);
    }

    /**
     * @param float $sourceAmount
     * @return string
     */
    public function getDestinationAmount(float $sourceAmount): string
    {
        $destinationAmount = ceil((float)$this->rate * $sourceAmount);

        return number_format($destinationAmount, 2);
    }
}
