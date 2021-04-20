<?php
declare(strict_types=1);
/**
 * Description:
 * API test for the class App\Controller\MoneyTransferController
 *
 * @package App\Tests\Controller
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Tests\Controller;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Tests\PhpUnitBase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MoneyTransferControllerTest
 *
 * @package App\Tests\Controller
 */
class MoneyTransferControllerTest extends PhpUnitBase
{
    /**
     * @group api
     */
    public function testGetExchangeRate(): void
    {
        self::ensureKernelShutdown();

        /** @var KernelBrowser $kernelBrowser */
        $kernelBrowser = static::createClient();
        /** @var string $route */
        $route = $kernelBrowser->getContainer()->get('router')->generate('getExchangeRate', array(), false);
        $kernelBrowser->request(Request::METHOD_GET, self::BASE_URL . $route . '?fromCurrency=1&toCurrency=2&sourceAmount=100');
        /** @var string $exchangeRate */
        $exchangeRate = $kernelBrowser->getResponse()->getContent();
        $this->assertEquals(
            '{"destinationAmount":"11,500.00","exchangeRate":"115.00"}',
            $exchangeRate,
            'Got unexpected exchange rate and/or destination amount'
        );
    }
}
