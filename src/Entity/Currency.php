<?php
declare(strict_types=1);
/**
 * Description:
 * holds all supported currency info
 *
 * @package App\Entity
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Entity;

use App\Entity\EntityTrait\DateCreated;
use App\Entity\EntityTrait\DateUpdated;
use App\Entity\EntityTrait\ID;
use App\Entity\EntityTrait\StatusId;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="currency")
 */
class Currency
{
    /**
     * Add the property id along with its getter
     * Add the property Status along with its setter and getter
     * Add the property DateCreated along with its setter and getter
     * Add the property DateUpdated along with its setter and getter
     */
    use ID, StatusId, DateCreated, DateUpdated;

    /**
     * 3 letter currency code e.g. GBP
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;

    /**
     * name of the currency e.g. Great Britain Pound
     * @ORM\Column(name="name", type="string", length=45)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=ExchangeRate::class, mappedBy="fromCurrency", cascade={"persist", "remove"})
     */
    private $exchangeRateFromCurrency;

    /**
     * @ORM\OneToOne(targetEntity=ExchangeRate::class, mappedBy="toCurrency", cascade={"persist", "remove"})
     */
    private $exchangeRateToCurrency;

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

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

    /**
     * @return ExchangeRate|null
     */
    public function getExchangeRateFromCurrency(): ?ExchangeRate
    {
        return $this->exchangeRateFromCurrency;
    }

    /**
     * @param ExchangeRate $exchangeRateFromCurrency
     * @return $this
     */
    public function setExchangeRateFromCurrency(ExchangeRate $exchangeRateFromCurrency): self
    {
        // set the owning side of the relation if necessary
        if ($exchangeRateFromCurrency->getFromCurrency() !== $this) {
            $exchangeRateFromCurrency->setFromCurrency($this);
        }

        $this->exchangeRateFromCurrency = $exchangeRateFromCurrency;

        return $this;
    }

    /**
     * @return ExchangeRate|null
     */
    public function getExchangeRateToCurrency(): ?ExchangeRate
    {
        return $this->exchangeRateToCurrency;
    }

    /**
     * @param ExchangeRate $exchangeRateToCurrency
     * @return $this
     */
    public function setExchangeRateToCurrency(ExchangeRate $exchangeRateToCurrency): self
    {
        // set the owning side of the relation if necessary
        if ($exchangeRateToCurrency->getToCurrency() !== $this) {
            $exchangeRateToCurrency->setToCurrency($this);
        }

        $this->exchangeRateToCurrency = $exchangeRateToCurrency;

        return $this;
    }
}
