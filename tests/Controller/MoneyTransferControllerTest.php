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

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MoneyTransferControllerTest
 *
 * @package App\Tests\Controller
 */
class MoneyTransferControllerTest extends WebTestCase
{
    /** @var string */
    private const BASE_URL = 'http://sendmoney.zit';

    /**
     * @group api
     */
    public function testGetCurrencies(): void
    {
        self::ensureKernelShutdown();

        /** @var KernelBrowser $kernelBrowser */
        $kernelBrowser = static::createClient();
        /** @var string $api */
        $api = $kernelBrowser->getContainer()->get('router')->generate('getCurrencies', array(), false);
        $kernelBrowser->request(Request::METHOD_GET, self::BASE_URL . $api);
        /** @var string $currenciesInJson */
        $currenciesInJson = $kernelBrowser->getResponse()->getContent();
        /** @var array $currencies */
        $currencies = json_decode($currenciesInJson, true);

        //remove id from the records as id can be changed at some point
        $currencies = array_map(function ($currency): string {
            return $currency['currency'];
        }, $currencies);

        $expected = ['GBP - British pound', 'BDT - Bangladeshi taka'];
        sort($expected);
        sort($currencies);
        $this->assertEquals($expected, $currencies, 'Can not return expected currencies');
    }

    /**
     * @group api
     */
    public function testGetExchangeRate(): void
    {
        self::ensureKernelShutdown();

        /** @var KernelBrowser $kernelBrowser */
        $kernelBrowser = static::createClient();
        /** @var string $api */
        $api = $kernelBrowser->getContainer()->get('router')->generate('getExchangeRate', array(), false);
        $kernelBrowser->request(Request::METHOD_GET, self::BASE_URL . $api);
        /** @var string $currenciesInJson */
        $currenciesInJson = $kernelBrowser->getResponse()->getContent();
        /** @var array $currencies */
        $currencies = json_decode($currenciesInJson, true);

        //remove id from the records as id can be changed at some point
        $currencies = array_map(function ($currency): string {
            return $currency['currency'];
        }, $currencies);

        $expected = ['GBP - British pound', 'BDT - Bangladeshi taka'];
        sort($expected);
        sort($currencies);
        $this->assertEquals($expected, $currencies, 'Can not return expected currencies');
    }
}
