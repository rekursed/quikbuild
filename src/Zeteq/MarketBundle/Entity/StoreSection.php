<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="store_section")
  */
class StoreSection
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
     * @ORM\Column(type="text",  nullable=true)
     */
    protected $description;
    
    
      /**
     * @ORM\OneToMany(targetEntity="StoreCategory", mappedBy="store_section",cascade={"remove"})
     */
    protected $store_categories;


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
        $this->store_categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

        public function __toString()
    {
        return $this->getName();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return StoreSection
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
     * @return StoreSection
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
     * Add store_categories
     *
     * @param \Zeteq\MarketBundle\Entity\StoreCategory $storeCategories
     * @return StoreSection
     */
    public function addStoreCategorie(\Zeteq\MarketBundle\Entity\StoreCategory $storeCategories)
    {
        $this->store_categories[] = $storeCategories;
    
        return $this;
    }

    /**
     * Remove store_categories
     *
     * @param \Zeteq\MarketBundle\Entity\StoreCategory $storeCategories
     */
    public function removeStoreCategorie(\Zeteq\MarketBundle\Entity\StoreCategory $storeCategories)
    {
        $this->store_categories->removeElement($storeCategories);
    }

    /**
     * Get store_categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStoreCategories()
    {
        return $this->store_categories;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return StoreSection
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