<?php
declare(strict_types=1);
/**
 * Description:
 * holds common functionalities used by the controllers
 *
 * @package App\Tests
 *
 * @copyright 2021 Md Fahim Uddin
 */

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PhpUnitBaseTest
 *
 */
class PhpUnitBase  extends WebTestCase
{
    /** @var string */
    protected const BASE_URL = 'http://sendmoney.zit';

    /** @var EntityManager $em */
    protected $em;

    /**
     * PhpUnitBase constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        self::bootKernel();
        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();
    }
}
