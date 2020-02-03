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
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPublishedById(int $id)
    {
        $qb = $this->createQueryBuilder('p');

        # expr() Expression
        # expr()->count()
        $qb
            ->where(
                $qb->expr()->eq('p.id', ':post_id'),
                $qb->expr()->isNotNull('p.published_at') # where published_at IS NOT NULL
            )
        ->setParameter('post_id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
