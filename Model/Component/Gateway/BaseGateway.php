<?php

/*
 * This file is part of the CCDNUser SecurityBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\SecurityBundle\Model\Component\Gateway;

use CCDNUser\SecurityBundle\Gateway\BaseGatewayInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;

/**
 *
 * @category CCDNUser
 * @package  SecurityBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserSecurityBundle
 * @abstract
 *
 */
abstract class BaseGateway
{
    /**
     *
     * @access protected
     * @var EntityManager $em
     */
    protected $em;

    /**
     *
     * @access private
     * @var string $entityClass
     */
    protected $entityClass;

    /**
     * @access public
     *
     * @param ObjectManager $em
     * @param string        $entityClass
     *
     * @throws \Exception
     */
    public function __construct(ObjectManager $em, $entityClass)
    {
        if (null == $entityClass) {
            throw new \Exception('Entity class for gateway must be specified!');
        }

        $this->entityClass = $entityClass;
        $this->em = $em;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @access public
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->em->createQueryBuilder();
    }

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array        $parameters
     *
     * @throws NonUniqueResultException
     * @return ArrayCollection
     */
    public function one(QueryBuilder $qb, $parameters = array())
    {
        if (count($parameters)) {
            $qb->setParameters($parameters);
        }

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array       $parameters
     *
     * @return ArrayCollection
     */
    public function all(QueryBuilder $qb, $parameters = array())
    {
        if (count($parameters)) {
            $qb->setParameters($parameters);
        }

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * @access public
     *
     * @param Object $entity
     *
     * @throws ORMException
     * @return $this
     */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

    /**
     * @access public
     *
     * @param Object $entity
     *
     * @throws ORMException
     * @return $this
     */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }

    /**
     * @access public
     * @throws ORMException
     * @throws OptimisticLockException
     * @return $this
     */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

    /**
     * @access public
     *
     * @param Object $entity
     *
     * @throws ORMException
     * @return $this
     */
    public function refresh($entity)
    {
        $this->em->refresh($entity);

        return $this;
    }
}
