<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_category")
  */
class ProductCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")

     */
    protected $id;

     /**
     * @ORM\Column(type="string",length=130,  nullable=false)
      *   @GRID\Column(operatorsVisible=false)
      * 
     */
    protected $name;
         
   /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true, nullable=true)
   */
    private $slug;  
    
   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $enabled;


     
     /**
     * @ORM\Column(type="text",  nullable=false)
     */
    protected $description;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductSection", inversedBy="product_categories")
     * @ORM\JoinColumn(name="product_section_id", referencedColumnName="id",nullable=false)
     * 
     */
    protected $product_section;

    
    /**
     * @ORM\ManyToMany(targetEntity="Product",mappedBy="categories")
     *
     */
    protected $products;    
    
    
    
        public function getEnabledProducts()
    {
  //      return $this->products;
        
 $products = $this->getProducts();

$criteria = Criteria::create()
    ->where(Criteria::expr()->eq("enabled", "1"))
//    ->orderBy(array("created" => Criteria::ASC))
 //   ->setFirstResult(0)
  //  ->setMaxResults(20)
;

$enabled_products = $products->matching($criteria);
return $enabled_products;       
        
        
        
        
        
        
        
        
        
        
        
        
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

    
    
        public function __toString() {
        return $this->getName();
    }
    /**
     * Set description
     *
     * @param string $description
     * @return Store
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductCategory
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return ProductCategory
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set product_section
     *
     * @param \Zeteq\MarketBundle\Entity\ProductSection $productSection
     * @return ProductCategory
     */
    public function setProductSection(\Zeteq\MarketBundle\Entity\ProductSection $productSection)
    {
        $this->product_section = $productSection;
    
        return $this;
    }

    /**
     * Get product_section
     *
     * @return \Zeteq\MarketBundle\Entity\ProductSection 
     */
    public function getProductSection()
    {
        return $this->product_section;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $products
     * @return ProductCategory
     */
    public function addProduct(\Zeteq\MarketBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    
        return $this;
    }

    /**
     * Remove products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $products
     */
    public function removeProduct(\Zeteq\MarketBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ProductCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}