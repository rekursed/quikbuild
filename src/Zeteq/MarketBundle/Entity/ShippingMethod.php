<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Zeteq\UserBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="shipping_method")
 * @ORM\HasLifecycleCallbacks 
 */
class ShippingMethod
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
      * @GRID\Column(filterable=false)
     */
    protected $id;
    
 

            /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="shipping_method",cascade={"persist"})
     */
    protected $carts;


               /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $name;


               /**
     * @ORM\Column(type="decimal",  nullable=true)
     */
    protected $cost;
    
    public function __toString() {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return ShippingMethod
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cost
     *
     * @param float $cost
     * @return ShippingMethod
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * Get cost
     *
     * @return float 
     */
    public function getCost()
    {
        return $this->cost;
    }

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->carts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
 

    /**
     * Add carts
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $carts
     * @return ShippingMethod
     */
    public function addCart(\Zeteq\MarketBundle\Entity\Cart $carts)
    {
        $this->carts[] = $carts;
    
        return $this;
    }

    /**
     * Remove carts
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $carts
     */
    public function removeCart(\Zeteq\MarketBundle\Entity\Cart $carts)
    {
        $this->carts->removeElement($carts);
    }

    /**
     * Get carts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCarts()
    {
        return $this->carts;
    }
}