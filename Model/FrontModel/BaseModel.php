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

namespace CCDNUser\SecurityBundle\Model\FrontModel;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use CCDNUser\SecurityBundle\Model\Component\Manager\ManagerInterface;
use CCDNUser\SecurityBundle\Model\Component\Repository\RepositoryInterface;

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
 * @abstract
 */
abstract class BaseModel
{
    /**
     * @access protected
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @access protected
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @access protected
     * @var EventDispatcherInterface $dispatcher
     */
    protected $dispatcher;

    /**
     * @access public
     *
     * @param EventDispatcherInterface $dispatcher
     * @param RepositoryInterface      $repository
     * @param ManagerInterface         $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RepositoryInterface $repository, ManagerInterface $manager)
    {
        $this->dispatcher = $dispatcher;

        $repository->setModel($this);
        $this->repository = $repository;

        $manager->setModel($this);
        $this->manager = $manager;
    }

    /**
     * @access public
     * @return RepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @access public
     * @return ManagerInterface
     */
    public function getManager()
    {
        return $this->manager;
    }
}
