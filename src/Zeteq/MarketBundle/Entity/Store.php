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
 * @ORM\Table(name="store")
 * @ORM\HasLifecycleCallbacks 
 * @UniqueEntity(fields="store_name", message="Sorry, this name is already taken.")
  */
class Store
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
      * @GRID\Column(filterable=false)
     */
    protected $id;


     /**
     * @ORM\Column(type="string", length=150,  nullable=false,unique=true)
     * @Assert\Length(
     *      min = "5",
     *      max = "40",
     *      minMessage = "Name  must be at least {{ limit }} characters length",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters length"
     * )
    *   @GRID\Column(operatorsVisible=false)
     */
    protected $store_name;
    

    
             /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="store",cascade={"remove"})
     */
    protected $carts;
    
       /**
     * @Gedmo\Slug(fields={"store_name"})
     * @ORM\Column(length=128, unique=true, nullable=false)
   */
    private $slug;  
    
    

         /**
     * @ORM\Column(type="string", length=20,  nullable=true)
     */
    protected $web_address;

    
         /**
     * @ORM\Column(type="string", length=20,  nullable=false)
     */
    protected $email;
    
    
         /**
     * @ORM\Column(type="string", length=20,  nullable=false)
     */
    protected $phone;
    
    
         /**
     * @ORM\Column(type="string", length=300,  nullable=true)
     */
    protected $address;
    
       /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $facebook_page;
    
    
    

           /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $twitter;

               /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $google_plus;
    
    
               /**
     * @ORM\Column(type="string", length=150,  nullable=false)
     */
    protected $short_description;
    
     /**
     * @ORM\Column(type="text",  nullable=true)
     */
    protected $description;
    
     /**
     * @ORM\Column(type="text",  nullable=true)
     */
    protected $meta_key_words;
    

       
   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $use_store_layout;
    
       
   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $use_site_layout;
    
   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $approved;    
   
   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $enabled;

       /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $featured;
    
    
       /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $viewed;
    
    
     /**
     * @ORM\ManyToOne(targetEntity="StoreCategory", inversedBy="stores")
     * @ORM\JoinColumn(name="store_category_id", referencedColumnName="id",nullable=false)
     * 
     */
    protected $store_category;
    
    
    
     /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="store",cascade={"remove"})
     */
    protected $products;
    
     /**
     * @ORM\OneToMany(targetEntity="StoreProductCategory", mappedBy="store",cascade={"remove"})
     */
    protected $store_product_categories;



     /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="store",cascade={"remove"})
     */
    protected $pages;
         /**
     * @ORM\ManyToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="stores")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=true)
    * @GRID\Column(field="user.email",filter="select", operatorsVisible=false, title="User")
     */
    protected $user;
    
    
    /**
     * @ORM\OneToMany(targetEntity="FavoriteStore", mappedBy="store")
     */
    private $favorite_stores;
    
    
    
    
    //////////image uploading begin
    
    

 /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $profile_image_path;
    
    /**
     * @var string $image
     * @Assert\File( maxSize = "5024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="profile_image", type="string", length=255,nullable=true)
     */
    private $profile_image;
    
    
public function getProfileImageWebPath() 
{
        return  'upload/store/images/'.$this->getId().'/'. $this->profile_image_path;
}
    

public function getFullImagePath() 
{
return   $this->getUploadRootDir(). $this->profile_image_path;
}
 
protected function getUploadRootDir() 
{
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../public_html/upload/store/images/'.$this->getId().'/';
}
 


   /**
     * @ORM\PrePersist()
     */
    public function uploadpersistProfileImage() 
{
        // the file property can be empty if the field is not required
        if (null === $this->profile_image) {
            return;
		}

        
        $this->profile_image->move($this->getUploadRootDir(),$this->profile_image->getClientOriginalName());

        $this->setProfileImagePath($this->profile_image->getClientOriginalName());
         $this->setProfileImage('');
    }
 
    
       /**
     * @ORM\PreUpdate()
     */
    
    public function uploadupdateProfileImage() {

            if (null === $this->profile_image) {
            return;
        }
        
       $this->profile_image->move($this->getUploadRootDir(), $this->profile_image->getClientOriginalName());
       $this->setProfileImagePath($this->profile_image->getClientOriginalName());
         $this->setProfileImage('');
        
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeProfileImage()
    {
        try{
       unlink($this->getFullImagePath());
        }catch(\Exception $e){
            
        }
    }



    
    /////////image uploading end
    
    
    
    
    //////////image uploading begin
    
    

 /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $coverphoto_path;
    
    /**
     * @var string $image
     * @Assert\File( maxSize = "5024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $coverphoto_image;
    
    
public function getcoverphotoWebPath() 
{
        return  'upload/store/images/'.$this->getId().'/'. $this->coverphoto_path;
}
    

public function getCoverphotoFullImagePath() 
{
return   $this->getUploadRootDir(). $this->coverphoto_path;
}
 
 
 


   /**
     * @ORM\PrePersist()
     */
    public function uploadpersistCoverphotoImage() 
{
        // the file property can be empty if the field is not required
        if (null === $this->coverphoto_image) {
            return;
		}

        
        $this->coverphoto_image->move($this->getUploadRootDir(),$this->coverphoto_image->getClientOriginalName());

        $this->setCoverphotoPath($this->coverphoto_image->getClientOriginalName());
         $this->setProfileImage('');
    }
 
    
       /**
     * @ORM\PreUpdate()
     */
    
    public function uploadupdateCoverImage() {

            if (null === $this->coverphoto_image) {
            return;
        }
        
       $this->coverphoto_image->move($this->getUploadRootDir(), $this->coverphoto_image->getClientOriginalName());
       $this->setCoverphotoPath($this->coverphoto_image->getClientOriginalName());
         $this->setProfileImage('');
        
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeCoverImage()
    {
        try{
       unlink($this->getCoverphotoFullImagePath());
        }catch(\Exception $e){
            
        }
    }



    
    /////////image uploading end
    
    
            public function getEnabledPages()
    {
        
        


$s = $this->getPages();

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
    public function __toString() {
        return $this->store_name;
    }

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set store_name
     *
     * @param string $storeName
     * @return Store
     */
    public function setStoreName($storeName)
    {
        $this->store_name = $storeName;
    
        return $this;
    }

    /**
     * Get store_name
     *
     * @return string 
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

  

    /**
     * Set facebook_page
     *
     * @param string $facebookPage
     * @return Store
     */
    public function setFacebookPage($facebookPage)
    {
        $this->facebook_page = $facebookPage;
    
        return $this;
    }

    /**
     * Get facebook_page
     *
     * @return string 
     */
    public function getFacebookPage()
    {
        return $this->facebook_page;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Store
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    
        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
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
     * Set delivery_details
     *
     * @param string $deliveryDetails
     * @return Store
     */
    public function setDeliveryDetails($deliveryDetails)
    {
        $this->delivery_details = $deliveryDetails;
    
        return $this;
    }

    /**
     * Get delivery_details
     *
     * @return string 
     */
    public function getDeliveryDetails()
    {
        return $this->delivery_details;
    }

    /**
     * Set about_us
     *
     * @param string $aboutUs
     * @return Store
     */
    public function setAboutUs($aboutUs)
    {
        $this->about_us = $aboutUs;
    
        return $this;
    }

    /**
     * Get about_us
     *
     * @return string 
     */
    public function getAboutUs()
    {
        return $this->about_us;
    }

    /**
     * Set contact_us
     *
     * @param string $contactUs
     * @return Store
     */
    public function setContactUs($contactUs)
    {
        $this->contact_us = $contactUs;
    
        return $this;
    }

    /**
     * Get contact_us
     *
     * @return string 
     */
    public function getContactUs()
    {
        return $this->contact_us;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Store
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
     * Set profile_image_path
     *
     * @param string $profileImagePath
     * @return Store
     */
    public function setProfileImagePath($profileImagePath)
    {
        $this->profile_image_path = $profileImagePath;
    
        return $this;
    }

    /**
     * Get profile_image_path
     *
     * @return string 
     */
    public function getProfileImagePath()
    {
        return $this->profile_image_path;
    }

    /**
     * Set profile_image
     *
     * @param string $profileImage
     * @return Store
     */
    public function setProfileImage($profileImage)
    {
        $this->profile_image = $profileImage;
    
        return $this;
    }

    /**
     * Get profile_image
     *
     * @return string 
     */
    public function getProfileImage()
    {
        return $this->profile_image;
    }

    /**
     * Set store_category
     *
     * @param \Zeteq\MarketBundle\Entity\StoreCategory $storeCategory
     * @return Store
     */
    public function setStoreCategory(\Zeteq\MarketBundle\Entity\StoreCategory $storeCategory = null)
    {
        $this->store_category = $storeCategory;
    
        return $this;
    }

    /**
     * Get store_category
     *
     * @return \Zeteq\MarketBundle\Entity\StoreCategory 
     */
    public function getStoreCategory()
    {
        return $this->store_category;
    }

    /**
     * Add products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $products
     * @return Store
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
        
        


$products = $this->getProducts();

$criteria = Criteria::create()
    ->where(Criteria::expr()->eq("enabled", "1"))
    ->orderBy(array("created" => Criteria::ASC))
 //   ->setFirstResult(0)
  //  ->setMaxResults(20)
;

$enabled_products = $products->matching($criteria);
return $enabled_products;
        
        
    }
    
    
        public function getEnabledStoreProductCategories()
    {
        
        


$p = $this->getStoreProductCategories();

$criteria = Criteria::create()
    ->where(Criteria::expr()->eq("enabled", "1"))

;

$enabled = $p->matching($criteria);
return $enabled;
        
        
    }

    /**
     * Add pages
     *
     * @param \Zeteq\MarketBundle\Entity\Page $pages
     * @return Store
     */
    public function addPage(\Zeteq\MarketBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;
    
        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Zeteq\MarketBundle\Entity\Page $pages
     */
    public function removePage(\Zeteq\MarketBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set user
     *
     * @param \Zeteq\UserBundle\Entity\User $user
     * @return Store
     */
    public function setUser(\Zeteq\UserBundle\Entity\User $user = null)
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
     * Set coverphoto_path
     *
     * @param string $coverphotoPath
     * @return Store
     */
    public function setCoverphotoPath($coverphotoPath)
    {
        $this->coverphoto_path = $coverphotoPath;
    
        return $this;
    }

    /**
     * Get coverphoto_path
     *
     * @return string 
     */
    public function getCoverphotoPath()
    {
        return $this->coverphoto_path;
    }

    /**
     * Set coverphoto_image
     *
     * @param string $coverphotoImage
     * @return Store
     */
    public function setCoverphotoImage($coverphotoImage)
    {
        $this->coverphoto_image = $coverphotoImage;
    
        return $this;
    }

    /**
     * Get coverphoto_image
     *
     * @return string 
     */
    public function getCoverphotoImage()
    {
        return $this->coverphoto_image;
    }

    /**
     * Set web_address
     *
     * @param string $webAddress
     * @return Store
     */
    public function setWebAddress($webAddress)
    {
        $this->web_address = $webAddress;
    
        return $this;
    }

    /**
     * Get web_address
     *
     * @return string 
     */
    public function getWebAddress()
    {
        return $this->web_address;
    }

    /**
     * Set short_description
     *
     * @param string $shortDescription
     * @return Store
     */
    public function setShortDescription($shortDescription)
    {
        $this->short_description = $shortDescription;
    
        return $this;
    }

    /**
     * Get short_description
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * Add store_product_categories
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $storeProductCategories
     * @return Store
     */
    public function addStoreProductCategorie(\Zeteq\MarketBundle\Entity\StoreProductCategory $storeProductCategories)
    {
        $this->store_product_categories[] = $storeProductCategories;
    
        return $this;
    }

    /**
     * Remove store_product_categories
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $storeProductCategories
     */
    public function removeStoreProductCategorie(\Zeteq\MarketBundle\Entity\StoreProductCategory $storeProductCategories)
    {
        $this->store_product_categories->removeElement($storeProductCategories);
    }

    /**
     * Get store_product_categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStoreProductCategories()
    {
        return $this->store_product_categories;
    }

    /**
     * Set use_store_layout
     *
     * @param boolean $useStoreLayout
     * @return Store
     */
    public function setUseStoreLayout($useStoreLayout)
    {
        $this->use_store_layout = $useStoreLayout;
    
        return $this;
    }

    /**
     * Get use_store_layout
     *
     * @return boolean 
     */
    public function getUseStoreLayout()
    {
        return $this->use_store_layout;
    }

    /**
     * Set use_site_layout
     *
     * @param boolean $useSiteLayout
     * @return Store
     */
    public function setUseSiteLayout($useSiteLayout)
    {
        $this->use_site_layout = $useSiteLayout;
    
        return $this;
    }

    /**
     * Get use_site_layout
     *
     * @return boolean 
     */
    public function getUseSiteLayout()
    {
        return $this->use_site_layout;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Store
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
     * Set phone
     *
     * @param string $phone
     * @return Store
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Store
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Store
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set google_plus
     *
     * @param string $googlePlus
     * @return Store
     */
    public function setGooglePlus($googlePlus)
    {
        $this->google_plus = $googlePlus;
    
        return $this;
    }

    /**
     * Get google_plus
     *
     * @return string 
     */
    public function getGooglePlus()
    {
        return $this->google_plus;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Store
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    
        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set meta_key_words
     *
     * @param string $metaKeyWords
     * @return Store
     */
    public function setMetaKeyWords($metaKeyWords)
    {
        $this->meta_key_words = $metaKeyWords;
    
        return $this;
    }

    /**
     * Get meta_key_words
     *
     * @return string 
     */
    public function getMetaKeyWords()
    {
        return $this->meta_key_words;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     * @return Store
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    
        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set viewed
     *
     * @param integer $viewed
     * @return Store
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
    
        return $this;
    }

    /**
     * Get viewed
     *
     * @return integer 
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * Add carts
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $carts
     * @return Store
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

    /**
     * Add favorite_stores
     *
     * @param \Zeteq\MarketBundle\Entity\FavoriteStore $favoriteStores
     * @return Store
     */
    public function addFavoriteStore(\Zeteq\MarketBundle\Entity\FavoriteStore $favoriteStores)
    {
        $this->favorite_stores[] = $favoriteStores;
    
        return $this;
    }

    /**
     * Remove favorite_stores
     *
     * @param \Zeteq\MarketBundle\Entity\FavoriteStore $favoriteStores
     */
    public function removeFavoriteStore(\Zeteq\MarketBundle\Entity\FavoriteStore $favoriteStores)
    {
        $this->favorite_stores->removeElement($favoriteStores);
    }

    /**
     * Get favorite_stores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoriteStores()
    {
        return $this->favorite_stores;
    }
}