<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity
 * @ORM\Table(name="store_product_category")
 * @ORM\Entity(repositoryClass="Zeteq\MarketBundle\Entity\StoreProductCategoryRepository")
 */
class StoreProductCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string",length=130,  nullable=false)
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
     * @ORM\ManyToMany(targetEntity="Product",mappedBy="store_product_categories")
     *
     */
    protected $products;   
 
    
 
    
    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="store_product_categories")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id",nullable=false)
     * 
     */
    protected $store;


        
        /**
     * @ORM\OneToMany(targetEntity="StoreProductCategory", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="StoreProductCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id",nullable=true)
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     * @return StoreProductCategory
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
     * @return StoreProductCategory
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
     * Set description
     *
     * @param string $description
     * @return StoreProductCategory
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
     * Add products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $products
     * @return StoreProductCategory
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
    
    
        public function getEnabledProducts()
    {
        
        


$products = $this->getProducts()->toArray();

$ep = array_filter($products, function($i) {
    if ($i->getEnabled() == 1) {
        return true;    
    }
    return false;
});

return $ep;


//$criteria = Criteria::create()
//    ->where(Criteria::expr()->eq("enabled", "1"))
//    ->orderBy(array("created" => Criteria::ASC))
// //   ->setFirstResult(0)
//  //  ->setMaxResults(20)
//;
//
//$enabled_products = $products->matching($criteria);
//return $enabled_products;
        
        
    }

    /**
     * Set store
     *
     * @param \Zeteq\MarketBundle\Entity\Store $store
     * @return StoreProductCategory
     */
    public function setStore(\Zeteq\MarketBundle\Entity\Store $store)
    {
        $this->store = $store;
    
        return $this;
    }

    /**
     * Get store
     *
     * @return \Zeteq\MarketBundle\Entity\Store 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return StoreProductCategory
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

    /**
     * Add children
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $children
     * @return StoreProductCategory
     */
    public function addChildren(\Zeteq\MarketBundle\Entity\StoreProductCategory $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $children
     */
    public function removeChildren(\Zeteq\MarketBundle\Entity\StoreProductCategory $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $parent
     * @return StoreProductCategory
     */
    public function setParent(\Zeteq\MarketBundle\Entity\StoreProductCategory $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Zeteq\MarketBundle\Entity\StoreProductCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }
}