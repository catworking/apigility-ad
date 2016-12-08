<?php
namespace ApigilityAd\V1\Rest\Banner;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class BannerCollection  extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = BannerEntity::class;
}
