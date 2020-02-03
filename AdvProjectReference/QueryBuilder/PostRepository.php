<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }


    /**
     * @return \Doctrine\ORM\QueryBuilder
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findPublishedPosts()
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM post WHERE username = :username';
        $qb = $this->createQueryBuilder('p');

        $statement = $connection->prepare($sql);
        $statement->execute([
            'username' => 'admin'
        ]);

        return $statement->fetchAll();
    }

    # DEMO 1
    public function findPublishedPostsDemo1()
    {
        $qb = $this->createQueryBuilder('p');

        /* $qb->select('p.title', 'p.content', 'p.created_at') */
        /*
        $qb->select('u.username')
           //->innerJoin('App\Entity\User', 'u', Join::WITH, 'u.id = p.user') # u = u.id
           ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user') # u = u.id
           ->where('p.published_at IS NOT NULL')
           ->andWhere('');

        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where('p.published_at IS NOT NULL')
            ->andWhere('u.username LIKE :username')
            ->setParameter('username', 'admin');
        */

        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where(
                $qb->expr()->isNotNull('p.published_at'),
                $qb->expr()->like('u.username', ':username'), # notlike() NOT LIKE
                $qb->expr()->eq('u.username')
            //$qb->expr()->eq('u.username') # neq() NOT EQUAL
            )
            ->setParameter('username', 'admin');

        /* dump($qb->getQuery()->getResult()); */
        dump($qb->getQuery()->getSQL());

        return $qb;
    }


    # DEMO 2
    public function findPublishedPostsDemo2()
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where(
            # AND ...
                $qb->expr()->andX(
                    $qb->expr()->isNotNull('p.published_at'),
                    $qb->expr()->like('u.username', ':username')
                ),
                # OR ...
                $qb->expr()->orX(
                    $qb->expr()->isNotNull('p.published_at'),
                    $qb->expr()->like('u.username', ':username')
                )
            )
            ->setParameter('username', 'admin');

        /* dump($qb->getQuery()->getResult()); */
        dump($qb->getQuery()->getSQL());

        return $qb;
    }


    # DEMO 3
    public function findPublishedPostsDemo3()
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where(
            # OR ...
                $qb->expr()->orX(
                # AND ...
                    $qb->expr()->andX(
                        $qb->expr()->isNotNull('p.published_at'),
                        $qb->expr()->like('u.username', ':username')
                    ),
                    # AND ...
                    $qb->expr()->andX(
                        $qb->expr()->isNotNull('p.published_at'),
                        $qb->expr()->like('u.username', ':username')
                    )
                )
            )
            ->setParameter('username', 'admin');

        /* dump($qb->getQuery()->getResult()); */
        dump($qb->getQuery()->getSQL());

        return $qb;
    }

    public function findPublishedPostsDemo4()
    {
        $qb = $this->createQueryBuilder('p');

        $names = ['admin, jean, ahmed'];
        $names = \join(', ', $names);
        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where(
            # $qb->expr()->notIn('admin, jean, ahmed')
                $qb->expr()->notIn($names)
            )
            ->setParameter('username', 'admin');

        /* dump($qb->getQuery()->getResult()); */
        dump($qb->getQuery()->getSQL());

        return $qb;
    }



    public function findPublishedPostsDemo5()
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = p.user')
            ->where(
                ''
            )
            ->setMaxResults()
            ->setFirstResult(10) # Pagination
            ->setParameter('username', 'admin');

        return $qb->getQuery()->getResult();
    }


}
