<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity
 * @ORM\Table(name="store_category")
  */
class StoreCategory
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
     * @ORM\ManyToOne(targetEntity="StoreSection", inversedBy="store_categories")
     * @ORM\JoinColumn(name="store_section_id", referencedColumnName="id",nullable=false)
     * 
     */
    protected $store_section;

    
      /**
     * @ORM\OneToMany(targetEntity="Store", mappedBy="store_category",cascade={"remove"})
     */
    protected $stores;
    
            public function __toString()
    {
        return $this->getName();
    }
    
        public function getEnabledStores()
    {
        

$s = $this->getStores();
$criteria = Criteria::create()
    ->where(Criteria::expr()->eq("enabled", "1"))
  //  ->orderBy(array("created" => Criteria::ASC))
 //   ->setFirstResult(0)
  //  ->setMaxResults(20)
;

$enabled = $s->matching($criteria);
return $enabled;
        
        
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
     * Set name
     *
     * @param string $name
     * @return StoreCategory
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
     * @return StoreCategory
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
     * Set store_section
     *
     * @param \Zeteq\MarketBundle\Entity\StoreSection $storeSection
     * @return StoreCategory
     */
    public function setStoreSection(\Zeteq\MarketBundle\Entity\StoreSection $storeSection)
    {
        $this->store_section = $storeSection;
    
        return $this;
    }

    /**
     * Get store_section
     *
     * @return \Zeteq\MarketBundle\Entity\StoreSection 
     */
    public function getStoreSection()
    {
        return $this->store_section;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stores = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add stores
     *
     * @param \Zeteq\MarketBundle\Entity\Store $stores
     * @return StoreCategory
     */
    public function addStore(\Zeteq\MarketBundle\Entity\Store $stores)
    {
        $this->stores[] = $stores;
    
        return $this;
    }

    /**
     * Remove stores
     *
     * @param \Zeteq\MarketBundle\Entity\Store $stores
     */
    public function removeStore(\Zeteq\MarketBundle\Entity\Store $stores)
    {
        $this->stores->removeElement($stores);
    }

    /**
     * Get stores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return StoreCategory
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