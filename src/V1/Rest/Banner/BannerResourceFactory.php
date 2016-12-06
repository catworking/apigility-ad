<?php
namespace ApigilityAd\V1\Rest\Banner;

class BannerResourceFactory
{
    public function __invoke($services)
    {
        return new BannerResource($services);
    }
}
