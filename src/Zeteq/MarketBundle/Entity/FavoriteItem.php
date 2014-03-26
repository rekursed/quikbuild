<?php

namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="favorite_item")
 * @ORM\HasLifecycleCallbacks 
 */
class FavoriteItem {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="favorite_items")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="favorite_items")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
   

    public function __toString() {
        return $this->getName();
    }

       

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Zeteq\UserBundle\Entity\User $user
     * @return FavoriteItem
     */
    public function setUser(\Zeteq\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Zeteq\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set product
     *
     * @param \Zeteq\MarketBundle\Entity\Product $product
     * @return FavoriteItem
     */
    public function setProduct(\Zeteq\MarketBundle\Entity\Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \Zeteq\MarketBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}