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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use CCDNUser\SecurityBundle\Model\Component\Gateway\GatewayInterface;
use CCDNUser\SecurityBundle\Model\Component\Gateway\BaseGateway;
use CCDNUser\SecurityBundle\Entity\Session;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @category CCDNUser
 * @package  SecurityBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserSecurityBundle
 *
 */
class SessionGateway extends BaseGateway implements GatewayInterface
{
    /**
     *
     * @access private
     * @var string $queryAlias
     */
    private $queryAlias = 's';

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array        $parameters
     *
     * @throws NonUniqueResultException
     * @return ArrayCollection
     */
    public function findSession(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->one($qb, $parameters);
    }

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array        $parameters
     *
     * @return ArrayCollection
     */
    public function findSessions(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->all($qb, $parameters);
    }

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array        $parameters
     *
     * @throws NonUniqueResultException
     * @return int
     */
    public function countSessions(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createCountQuery();
        }

        if (null == $parameters) {
            $parameters = array();
        }

        $qb->setParameters($parameters);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    /**
     * @access public
     *
     * @param  string                     $column  = null
     * @param  array                      $aliases = null
     *
     * @return QueryBuilder
     */
    public function createCountQuery($column = null, Array $aliases = null)
    {
        if (null == $column) {
            $column = 'count(' . $this->queryAlias . '.id)';
        }

        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($column);
        }

        if (! in_array($column, $aliases)) {
            $aliases = array($column) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     * @access public
     *
     * @param  array                      $aliases = null
     *
     * @return QueryBuilder
     */
    public function createSelectQuery(Array $aliases = null)
    {
        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($this->queryAlias);
        }

        if (! in_array($this->queryAlias, $aliases)) {
            $aliases = array($this->queryAlias) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     * @access public
     *
     * @param Session $session
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @return $this
     */
    public function persistSession(Session $session)
    {
        $this->persist($session)->flush();

        return $this;
    }

    /**
     * @access public
     *
     * @param Session $session
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @return $this
     */
    public function updateSession(Session $session)
    {
        $this->persist($session)->flush();

        return $this;
    }

    /**
     * @access public
     *
     * @param Session $session
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @return $this
     */
    public function deleteSession(Session $session)
    {
        $this->remove($session)->flush();

        return $this;
    }
}
