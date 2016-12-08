<?php
namespace ApigilityAd\V1\Rest\Banner;

use ApigilityAd\DoctrineEntity\Position;
use ApigilityAd\V1\Rest\Position\PositionEntity;
use ApigilityCatworkFoundation\Base\ApigilityEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;

class BannerEntity extends ApigilityObjectStorageAwareEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 广告标题
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $title;

    /**
     * 图片地址
     *
     * @Column(type="string", length=200, nullable=false)
     */
    protected $image;

    /**
     * 广告链接
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $link;

    /**
     * 此Banner出现的所有位置
     *
     * @ManyToMany(targetEntity="Position", inversedBy="banners")
     * @JoinTable(name="banners_at_positions")
     */
    protected $positions;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->renderUriToUrl($this->image);
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setPositions($positions)
    {
        $this->positions = $positions;
        return $this;
    }

    public function getPositions()
    {
        return $this->getJsonValueFromDoctrineCollection($this->positions, PositionEntity::class);
    }
}
