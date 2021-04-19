<?php
declare(strict_types=1);
/**
 * Description:
 * holds latest exchnage rate
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
use App\Repository\ExchangeRateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExchangeRateRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="exchange_rate", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_exchange", columns={"from_currency", "to_currency"})
 * })
 */
class ExchangeRate
{
    /**
     * Add the property id along with its getter
     * Add the property Status along with its setter and getter
     * Add the property DateCreated along with its setter and getter
     * Add the property DateUpdated along with its setter and getter
     */
    use ID, StatusId, DateCreated, DateUpdated;

    /**
     * @ORM\OneToOne(targetEntity=Currency::class, inversedBy="exchangeRateFromCurrency", cascade={"persist"})
     * @ORM\JoinColumn(name="from_currency", nullable=false)
     */
    private $fromCurrency;

    /**
     * @ORM\OneToOne(targetEntity=Currency::class, inversedBy="exchangeRateToCurrency", cascade={"persist"})
     * @ORM\JoinColumn(name="to_currency", nullable=false)
     */
    private $toCurrency;

    /**
     * @ORM\Column(name="rate", type="decimal", precision=7, scale=2)
     */
    private $rate;

    /**
     * @return Currency|null
     */
    public function getFromCurrency(): ?Currency
    {
        return $this->fromCurrency;
    }

    /**
     * @param Currency $fromCurrency
     * @return $this
     */
    public function setFromCurrency(Currency $fromCurrency): self
    {
        $this->fromCurrency = $fromCurrency;

        return $this;
    }

    /**
     * @return Currency|null
     */
    public function getToCurrency(): ?Currency
    {
        return $this->toCurrency;
    }

    /**
     * @param Currency $toCurrency
     * @return $this
     */
    public function setToCurrency(Currency $toCurrency): self
    {
        $this->toCurrency = $toCurrency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRate(): ?string
    {
        return $this->rate;
    }

    /**
     * @param string $rate
     * @return $this
     */
    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
