<?php

namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_rating")
 * @ORM\HasLifecycleCallbacks 
 */
class ProductRating {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="product_ratings")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id",nullable=false)
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="product_ratings")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     */
    protected $user;

    public function __toString() {
        return $this->getName();
    }

    public function getRoundedRating() {
        return floor($this->getRating());
    }

    public function hasHalfStar() {
        if (ceil($this->rating) == $this->getRoundedRating()) {
            return 0;
        } else {
            return 1;
        }
    }

   
}
