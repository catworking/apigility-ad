<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 21:46
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

class BannerService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityAd\Service\PositionService
     */
    protected $positionService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->positionService = $services->get('ApigilityAd\Service\PositionService');
    }

    /**
     * 创建一个Banner广告
     *
     * @param \stdClass $data
     * @param array $positions
     * @return DoctrineEntity\Banner
     */
    public function createBanner(\stdClass $data, $positions = [])
    {
        $banner = new DoctrineEntity\Banner();
        $banner->setImage($data->image);
        if (isset($data->title)) $banner->setTitle($data->title);
        if (isset($data->link)) $banner->setLink($data->link);

        if (isset($data->positions)) {
            if (is_array($data->positions)) {
                foreach ($data->positions as $position_data) {
                    $position = $this->positionService->getPosition($position_data['id']);
                    if ($position instanceof DoctrineEntity\Position) {
                        $banner->addPosition($position);
                    }
                }
            }
        }

        if (!empty($positions)) {
            foreach ($positions as $position) {
                if ($position instanceof DoctrineEntity\Position) {
                    $banner->addPosition($position);
                }
            }
        }

        $this->em->persist($banner);
        $this->em->flush();

        return $banner;
    }

    /**
     * 获取一个横幅广告
     *
     * @param $banner_id
     * @return \ApigilityAd\DoctrineEntity\Position
     * @throws \Exception
     * @internal param $position_id
     */
    public function getBanner($banner_id)
    {
        $banner = $this->em->find('ApigilityAd\DoctrineEntity\Banner', $banner_id);
        if (empty($banner)) throw new \Exception('横幅广告不存在', 404);
        else return $banner;
    }

    /**
     * 获取横幅广告列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getBanners($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('b')->from('ApigilityAd\DoctrineEntity\Banner', 'b');

        $where = null;
        if (isset($params->position_id)) {
            $qb->innerJoin('b.positions', 'p');
            if (!empty($where)) $where .= ' AND ';
            $where = 'p.id = :position_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->position_id)) $qb->setParameter('position_id', $params->position_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}