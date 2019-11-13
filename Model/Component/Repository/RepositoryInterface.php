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

namespace CCDNUser\SecurityBundle\Model\Component\Repository;

use Doctrine\Common\Collections\ArrayCollection;
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
interface RepositoryInterface
{
    /**
     * @access public
     *
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway);

    /**
     *
     * @access public
     * @param ModelInterface $model
     * @return RepositoryInterface
     */
    public function setModel(ModelInterface $model);

    /**
     * @access public
     * @return GatewayInterface
     */
    public function getGateway();

    /**
     * @access public
     * @return QueryBuilder
     */
    public function getQueryBuilder();

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  array                                        $aliases = null
     * @return ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null);

    /**
     *
     * @access public
     * @param  array                                        $aliases = null
     * @return ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null);

    /**
     * @access public
     *
     * @param  QueryBuilder $qb
     *
     * @return ArrayCollection
     */
    public function one(QueryBuilder $qb);

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     *
     * @return QueryBuilder
     */
    public function all(QueryBuilder $qb);
}
