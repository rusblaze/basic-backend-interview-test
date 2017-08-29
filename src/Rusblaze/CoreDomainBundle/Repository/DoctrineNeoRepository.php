<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 29.08.17
 * Time: 11:56
 */

namespace Rusblaze\CoreDomainBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Rusblaze\CoreDomain\Neo\Neo;
use Rusblaze\CoreDomain\Neo\NeoRepository;

class DoctrineNeoRepository implements NeoRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrineEntityManager;

    /**
     * DoctrineNeoRepository constructor.
     *
     * @param EntityManagerInterface $doctrineEntityManager
     */
    public function __construct(EntityManagerInterface $doctrineEntityManager)
    {
        $this->doctrineEntityManager = $doctrineEntityManager;
    }

    /**
     * @inheritdoc
     */
    public function add(Neo $neo): Neo
    {
        $this->doctrineEntityManager->persist($neo);
        $this->doctrineEntityManager->flush();

        return $neo;
    }

    /**
     * @inheritdoc
     */
    public function has(Neo $neo): bool
    {
        return !is_null(
            $this->doctrineEntityManager->getRepository('RusblazeCoreDomain:Neo\Neo')
                                        ->findOneBy(
                                            [
                                                'reference' => $neo->getReference()
                                            ]
                                        )
        );
    }

    /**
     * @inheritdoc
     */
    public function getHazardous(): array
    {
        $qb = $this->doctrineEntityManager->createQueryBuilder();
        $qb->select('n')
           ->from('RusblazeCoreDomain:Neo\Neo', 'n')
           ->where('n.isHazardous = true');

        return $qb->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function getFastest(bool $isHazardous): ?Neo
    {
        $qb = $this->doctrineEntityManager->createQueryBuilder();
        $qb->select('n')
           ->from('RusblazeCoreDomain:Neo\Neo', 'n')
           ->where('n.isHazardous = ?1')
           ->orderBy('n.speed', 'DESC')
           ->setMaxResults(1);

        $qb->setParameter(1, $isHazardous);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getBestYear(bool $isHazardous): ?int
    {
        $emConfig = $this->doctrineEntityManager->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'Gesdinet\DQL\Datetime\Year');

        $query = $this->doctrineEntityManager->createQuery(
            'SELECT YEAR(n.date) as y, count(n.id) as c ' .
            'FROM RusblazeCoreDomain:Neo\Neo n ' .
            'WHERE n.isHazardous = ?1 ' .
            'GROUP BY y ' .
            'ORDER BY c DESC'
        );
        $query->setParameter(1, $isHazardous)
              ->setMaxResults(1);
        try {
            $result = $query->getSingleResult();
            return $result['y'];
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getBestMonth(bool $isHazardous): ?int
    {
        $emConfig = $this->doctrineEntityManager->getConfiguration();
        $emConfig->addCustomDatetimeFunction('MONTH', 'Gesdinet\DQL\Datetime\Month');

        $query = $this->doctrineEntityManager->createQuery(
            'SELECT MONTH(n.date) as m, count(n.id) as c ' .
            'FROM RusblazeCoreDomain:Neo\Neo n ' .
            'WHERE n.isHazardous = ?1 ' .
            'GROUP BY m ' .
            'ORDER BY c DESC'
        );
        $query->setParameter(1, $isHazardous)
              ->setMaxResults(1);
        try {
            $result = $query->getSingleResult();
            return $result['m'];
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}