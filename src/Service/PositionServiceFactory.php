<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 21:14
 */
namespace ApigilityAd\Service;

use Zend\ServiceManager\ServiceManager;

class PositionServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new PositionService($services);
    }
}