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
use Doctrine\Common\Persistence\ObjectManager;
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
 *
 */
interface GatewayInterface
{
    /**
     *
     * @access public
     * @param ObjectManager $em
     * @param string        $entityClass
     */
    public function __construct(ObjectManager $em, $entityClass);

    /**
     *
     * @access public
     * @return string
     */
    public function getEntityClass();

    /**
     * @access public
     * @return QueryBuilder
     */
    public function getQueryBuilder();

    /**
     * @access public
     *
     * @param  QueryBuilder $qb
     * @param  array        $parameters
     *
     * @return ArrayCollection
     */
    public function one(QueryBuilder $qb, $parameters = array());

    /**
     * @access public
     *
     * @param QueryBuilder $qb
     * @param array        $parameters
     *
     * @return ArrayCollection
     */
    public function all(QueryBuilder $qb, $parameters = array());

    /**
     *
     * @access public
     * @param  Object $entity
     * @return $this
     */
    public function persist($entity);

    /**
     *
     * @access public
     * @param  Object $entity
     * @return $this
     */
    public function remove($entity);

    /**
     *
     * @access public
     * @return $this
     */
    public function flush();

    /**
     *
     * @access public
     * @param  Object $entity
     * @return $this
     */
    public function refresh($entity);
}
