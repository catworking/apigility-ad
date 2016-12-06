<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 21:14
 */
namespace ApigilityAd\Service;

use ApigilityAd\V1\Rest\Position\PositionEntity;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Zend\Math\Rand;
use ApigilityAd\DoctrineEntity;

class PositionService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    public function createPosition(\stdClass $data)
    {
        $position = new DoctrineEntity\Position();
        $position->setName($data->name);
        $this->em->persist($position);
        $this->em->flush();

        return $position;
    }

    /**
     * 获取一个位置
     *
     * @param $position_id
     * @return null|object
     * @throws \Exception
     */
    public function getPosition($position_id)
    {
        $position = $this->em->find('ApigilityAd\DoctrineEntity\Position', $position_id);
        if (empty($position)) throw new \Exception('位置不存在', 404);
        else return $position;
    }

    /**
     * 获取位置列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getPositions($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('p')->from('ApigilityAd\DoctrineEntity\Position', 'p');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}