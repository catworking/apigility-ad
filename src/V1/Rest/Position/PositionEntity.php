<?php
namespace ApigilityAd\V1\Rest\Position;

use ApigilityCatworkFoundation\Base\ApigilityEntity;

class PositionEntity extends ApigilityEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 位置名称
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $name;

    /**
     * 该位置上的所有Banner广告
     *
     * @ManyToMany(targetEntity="Banner", mappedBy="positions")
     */
    protected $banners;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
