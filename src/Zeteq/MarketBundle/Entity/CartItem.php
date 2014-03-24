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
 * @ORM\Table(name="cart_item")
 * @ORM\HasLifecycleCallbacks 
 */
class CartItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
      * @GRID\Column(filterable=false)
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
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cart_items")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id",nullable=false)
     */
    protected $cart;


    
     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $quantity;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="cart_items")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id",nullable=false)
     */
    protected $product;
     
 public function getTotal()
 {
     $total = $this->getProduct()->getPrice() * $this->getQuantity();
     return $total;
     
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
     * Set created
     *
     * @param \DateTime $created
     * @return CartItem
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return CartItem
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set product_name
     *
     * @param string $productName
     * @return CartItem
     */
    public function setProductName($productName)
    {
        $this->product_name = $productName;
    
        return $this;
    }

    /**
     * Get product_name
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return CartItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set cart
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $cart
     * @return CartItem
     */
    public function setCart(\Zeteq\MarketBundle\Entity\Cart $cart)
    {
        $this->cart = $cart;
    
        return $this;
    }

    /**
     * Get cart
     *
     * @return \Zeteq\MarketBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set product
     *
     * @param \Zeteq\MarketBundle\Entity\Product $product
     * @return CartItem
     */
    public function setProduct(\Zeteq\MarketBundle\Entity\Product $product)
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

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return CartItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}