<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="product_section")
  */
class ProductSection
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
     * @ORM\OneToMany(targetEntity="ProductCategory", mappedBy="product_section",cascade={"remove"})
     */
    protected $product_categories;

    
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
     * Constructor
     */
    public function __construct()
    {
        $this->product_categories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return ProductSection
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
     * @return ProductSection
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
     * Add product_categories
     *
     * @param \Zeteq\MarketBundle\Entity\ProductCategory $productCategories
     * @return ProductSection
     */
    public function addProductCategorie(\Zeteq\MarketBundle\Entity\ProductCategory $productCategories)
    {
        $this->product_categories[] = $productCategories;
    
        return $this;
    }

    /**
     * Remove product_categories
     *
     * @param \Zeteq\MarketBundle\Entity\ProductCategory $productCategories
     */
    public function removeProductCategorie(\Zeteq\MarketBundle\Entity\ProductCategory $productCategories)
    {
        $this->product_categories->removeElement($productCategories);
    }

    /**
     * Get product_categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductCategories()
    {
        return $this->product_categories;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ProductSection
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