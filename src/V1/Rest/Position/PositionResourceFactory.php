<?php
namespace ApigilityAd\V1\Rest\Position;

class PositionResourceFactory
{
    public function __invoke($services)
    {
        return new PositionResource($services);
    }
}
