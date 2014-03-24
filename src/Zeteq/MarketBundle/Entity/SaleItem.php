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
 * @ORM\Table(name="sale_item")
 * @ORM\HasLifecycleCallbacks 
 */
class SaleItem
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
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="sale_items")
     * @ORM\JoinColumn(name="sale_id", referencedColumnName="id",nullable=false)
     */
    protected $sale;


               /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $product_name;
    
               /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $price;
    
     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $quantity;
    
    
   public function getTotal()
 {
     $total = $this->getPrice() * $this->getQuantity();
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
     * @return SaleItem
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
     * @return SaleItem
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
     * @return SaleItem
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
     * @return SaleItem
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
     * Set quantity
     *
     * @param integer $quantity
     * @return SaleItem
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

    /**
     * Set sale
     *
     * @param \Zeteq\MarketBundle\Entity\Sale $sale
     * @return SaleItem
     */
    public function setSale(\Zeteq\MarketBundle\Entity\Sale $sale)
    {
        $this->sale = $sale;
    
        return $this;
    }

    /**
     * Get sale
     *
     * @return \Zeteq\MarketBundle\Entity\Sale 
     */
    public function getSale()
    {
        return $this->sale;
    }
}