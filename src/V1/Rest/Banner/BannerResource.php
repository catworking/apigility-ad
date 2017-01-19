<?php
namespace ApigilityAd\V1\Rest\Banner;

use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;
use ApigilityCatworkFoundation\Base\ApigilityResource;

class BannerResource extends ApigilityResource
{
    /**
     * @var \ApigilityAd\Service\BannerService
     */
    protected $bannerService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);

        $this->bannerService = $this->serviceManager->get('ApigilityAd\Service\BannerService');
    }

    public function create($data)
    {
        try {
            return new BannerEntity($this->bannerService->createBanner($data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch($id)
    {
        try {
            return new BannerEntity($this->bannerService->getBanner($id), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new BannerCollection($this->bannerService->getBanners($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            return new BannerEntity($this->bannerService->updateBanner($id, $data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->bannerService->deleteBanner($id);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
