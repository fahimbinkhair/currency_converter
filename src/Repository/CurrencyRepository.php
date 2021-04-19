<?php
declare(strict_types=1);
/**
 * Description:
 *
 * @package App\Repository
 *
 * @copyright 2021 Md Fahim Uddin
 */
namespace App\Repository;

use App\Entity\Currency;
use App\Entity\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    /**
     * CurrencyRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * @return array
     */
    public function getCurrencies(): array
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('c')
            ->select("c.id, CONCAT(c.code, ' - ', c.name) AS currency")
            ->where('c.status = :status')
            ->setParameter('status', Status::STATUS['active']);

        return $qb->getQuery()->getResult();
    }
}
