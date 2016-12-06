<?php
namespace ApigilityAd\V1\Rest\Position;

use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;
use ApigilityCatworkFoundation\Base\ApigilityResource;

class PositionResource extends ApigilityResource
{

    protected $positionService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);

        $this->positionService = $this->serviceManager->get('ApigilityAd\Service\PositionService');
    }

    public function fetch($id)
    {
        try {
            return new PositionEntity($this->positionService->getPosition($id));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new PositionCollection($this->positionService->getPositions($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
