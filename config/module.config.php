<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityAd\V1\Rest\Banner\BannerResource::class => \ApigilityAd\V1\Rest\Banner\BannerResourceFactory::class,
            \ApigilityAd\V1\Rest\Position\PositionResource::class => \ApigilityAd\V1\Rest\Position\PositionResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-ad.rest.banner' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ad/banner[/:banner_id]',
                    'defaults' => [
                        'controller' => 'ApigilityAd\\V1\\Rest\\Banner\\Controller',
                    ],
                ],
            ],
            'apigility-ad.rest.position' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ad/position[/:position_id]',
                    'defaults' => [
                        'controller' => 'ApigilityAd\\V1\\Rest\\Position\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-ad.rest.banner',
            1 => 'apigility-ad.rest.position',
        ],
    ],
    'zf-rest' => [
        'ApigilityAd\\V1\\Rest\\Banner\\Controller' => [
            'listener' => \ApigilityAd\V1\Rest\Banner\BannerResource::class,
            'route_name' => 'apigility-ad.rest.banner',
            'route_identifier_name' => 'banner_id',
            'collection_name' => 'banner',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'position_id',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityAd\V1\Rest\Banner\BannerEntity::class,
            'collection_class' => \ApigilityAd\V1\Rest\Banner\BannerCollection::class,
            'service_name' => 'Banner',
        ],
        'ApigilityAd\\V1\\Rest\\Position\\Controller' => [
            'listener' => \ApigilityAd\V1\Rest\Position\PositionResource::class,
            'route_name' => 'apigility-ad.rest.position',
            'route_identifier_name' => 'position_id',
            'collection_name' => 'position',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityAd\V1\Rest\Position\PositionEntity::class,
            'collection_class' => \ApigilityAd\V1\Rest\Position\PositionCollection::class,
            'service_name' => 'Position',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityAd\\V1\\Rest\\Banner\\Controller' => 'HalJson',
            'ApigilityAd\\V1\\Rest\\Position\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityAd\\V1\\Rest\\Banner\\Controller' => [
                0 => 'application/vnd.apigility-ad.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityAd\\V1\\Rest\\Position\\Controller' => [
                0 => 'application/vnd.apigility-ad.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityAd\\V1\\Rest\\Banner\\Controller' => [
                0 => 'application/vnd.apigility-ad.v1+json',
                1 => 'application/json',
            ],
            'ApigilityAd\\V1\\Rest\\Position\\Controller' => [
                0 => 'application/vnd.apigility-ad.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityAd\V1\Rest\Banner\BannerEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-ad.rest.banner',
                'route_identifier_name' => 'banner_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityAd\V1\Rest\Banner\BannerCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-ad.rest.banner',
                'route_identifier_name' => 'banner_id',
                'is_collection' => true,
            ],
            \ApigilityAd\V1\Rest\Position\PositionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-ad.rest.position',
                'route_identifier_name' => 'position_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityAd\V1\Rest\Position\PositionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-ad.rest.position',
                'route_identifier_name' => 'position_id',
                'is_collection' => true,
            ],
        ],
    ],
];
