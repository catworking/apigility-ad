<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 20:15
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
 * Class Position
 * @package ApigilityAd\DoctrineEntity
 * @Entity @Table(name="apigilityad_position")
 */
class Position
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

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setBanners($banners)
    {
        $this->banners = $banners;
        return $this;
    }

    public function getBanners()
    {
        return $this->banners;
    }
}