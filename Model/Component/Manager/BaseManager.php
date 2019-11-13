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

namespace CCDNUser\SecurityBundle\Model\Component\Manager;

use CCDNUser\SecurityBundle\Model\Component\Repository\RepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\QueryBuilder;
use CCDNUser\SecurityBundle\Model\Component\Gateway\GatewayInterface;
use CCDNUser\SecurityBundle\Model\FrontModel\ModelInterface;

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
abstract class BaseManager
{
    /**
     * @access protected
     * @var GatewayInterface $gateway
     */
    protected $gateway;

    /**
     * @access protected
     * @var ModelInterface $model
     */
    protected $model;

    /**
     * @access protected
     * @var EventDispatcherInterface $dispatcher
     */
    protected $dispatcher;

    /**
     * @access public
     *
     * @param EventDispatcherInterface $dispatcher
     * @param GatewayInterface         $gateway
     */
    public function __construct(EventDispatcherInterface $dispatcher, GatewayInterface $gateway)
    {
        $this->dispatcher = $dispatcher;
        $this->gateway = $gateway;
    }

    /**
     * @access public
     *
     * @param ModelInterface $model
     *
     * @return $this
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @access public
     * @return GatewayInterface
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @access public
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->gateway->getQueryBuilder();
    }

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  array                                        $aliases = null
     * @return ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null)
    {
        return $this->gateway->createCountQuery($column, $aliases);
    }

    /**
     *
     * @access public
     * @param  array                                        $aliases = null
     * @return ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null)
    {
        return $this->gateway->createSelectQuery($aliases);
    }

    /**
     * @access public
     *
     * @param  QueryBuilder $qb
     *
     * @return ArrayCollection
     */
    public function one(QueryBuilder $qb)
    {
        return $this->gateway->one($qb);
    }

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     *
     * @return ArrayCollection
     */
    public function all(QueryBuilder $qb)
    {
        return $this->gateway->all($qb);
    }

    /**
     * @access public
     *
     * @param  Object                                                            $entity
     *
     * @return $this
     */
    public function persist($entity)
    {
        $this->gateway->persist($entity);

        return $this;
    }

    /**
     * @access public
     *
     * @param  Object                                                            $entity
     *
     * @return $this
     */
    public function remove($entity)
    {
        $this->gateway->remove($entity);

        return $this;
    }

    /**
     * @access public
     * @return $this
     */
    public function flush()
    {
        $this->gateway->flush();

        return $this;
    }

    /**
     * @access public
     *
     * @param  Object                                                            $entity
     *
     * @return $this
     */
    public function refresh($entity)
    {
        $this->gateway->refresh($entity);

        return $this;
    }
}
