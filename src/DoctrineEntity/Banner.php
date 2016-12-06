<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 20:16
 */
namespace ApigilityAd\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Banner
 * @package ApigilityAd\DoctrineEntity
 * @Entity @Table(name="apigilityad_banner")
 */
class Banner
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
     * @JoinTable(name="apigilityad_banners_at_positions")
     */
    protected $positions;

    public function __construct()
    {
        $this->positions = new ArrayCollection();
    }

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
        return $this->image;
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

    public function addPosition(Position $position)
    {
        $this->positions[] = $position;
    }

    public function getPositions()
    {
        return $this->positions;
    }
}