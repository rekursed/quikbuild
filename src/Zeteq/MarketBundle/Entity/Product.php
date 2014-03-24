<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks
  * @ORM\Entity(repositoryClass="Zeteq\MarketBundle\Entity\ProductRepository")
  */
class Product
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
     * @ORM\Column(type="string",length=130,  nullable=false)
      *   @GRID\Column(operatorsVisible=false)
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
    protected $out_of_stock;  
    
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
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $clearance;
    
    
       /**
     * @ORM\Column(type="float",nullable=true)
     * @GRID\Column(filterable=false)
     */
    protected $price;
    
       /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $clearance_price;





    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="related_products")
     */
    private $products_related_to_me;

    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="products_related_to_me")
     * @ORM\JoinTable(name="related_prods",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="related_product_id", referencedColumnName="id")}
     *      )
     */
    private $related_products;



         /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="product",cascade={"persist"})
     */
    protected $cart_items;

    /**
     * @ORM\ManyToMany(targetEntity="ProductImage", inversedBy="products" ,cascade={"persist","remove"})
     *
     */
    protected $product_images;

    
    
    
     /**
     * @ORM\Column(type="text",  nullable=false)
     */
    protected $description;
    
      /**
     * @ORM\Column(type="string",length=150, nullable=false)
     */
    protected $meta_description;
    
         /**
     * @ORM\Column(type="text",  nullable=false)
     */
    protected $meta_keywords;
    
    
    
    
    
        /**
     * @ORM\ManyToMany(targetEntity="ProductCategory", inversedBy="products" ,cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
      * @ORM\OrderBy({"name" = "ASC"})
    * @GRID\Column(field="categories.name",filter="select", operatorsVisible=false, title="Category")
     */
    protected $categories;
    


        /**
     * @ORM\ManyToMany(targetEntity="StoreProductCategory", inversedBy="products" ,cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
      * @ORM\OrderBy({"name" = "ASC"})

     */
    protected $store_product_categories;
        
    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="products")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id",nullable=false)
     * @GRID\Column(field="store.store_name",filter="select", operatorsVisible=false, title="Store")
     */
    protected $store;

    
    //////////image uploading begin
    
    

 /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $image_path;
    
    /**
     * @var string $image
     * @Assert\File( maxSize = "5024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="image", type="string", length=255,nullable=true)
     */
    private $image;
    
    public function __toString() {
        return $this->getName();
    }
    
public function getWebPath() 
{
        return  'upload/product/images/'.$this->getStore()->getId().'/'. $this->image_path;
}
    

public function getFullImagePath() 
{
return   $this->getUploadRootDir(). $this->image_path;
}
 
protected function getUploadRootDir() 
{
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../public_html/upload/product/images/'.$this->getStore()->getId().'/';
}
 


   /**
     * @ORM\PrePersist()
     */
    public function uploadpersistImage() 
{
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
		}

        
        $this->image->move($this->getUploadRootDir(),$this->image->getClientOriginalName());

        $this->setImagePath($this->image->getClientOriginalName());
         $this->setImage('');
    }
 
    
       /**
     * @ORM\PreUpdate()
     */
    
    public function uploadupdateImage() {

            if (null === $this->image) {
            return;
        }
        
       $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
       $this->setImagePath($this->image->getClientOriginalName());
         $this->setImage('');
        
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        try{
       unlink($this->getFullImagePath());
        }catch(\Exception $e){
            
        }
    }



    
    /////////image uploading end

  

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->store_product_categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Product
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
     * @return Product
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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set image_path
     *
     * @param string $imagePath
     * @return Product
     */
    public function setImagePath($imagePath)
    {
        $this->image_path = $imagePath;
    
        return $this;
    }

    /**
     * Get image_path
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param \Zeteq\MarketBundle\Entity\ProductCategory $categories
     * @return Product
     */
    public function addCategorie(\Zeteq\MarketBundle\Entity\ProductCategory $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Zeteq\MarketBundle\Entity\ProductCategory $categories
     */
    public function removeCategorie(\Zeteq\MarketBundle\Entity\ProductCategory $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add store_product_categories
     *
     * @param \Zeteq\MarketBundle\Entity\StoreProductCategory $storeProductCategories
     * @return Product
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
     * Set store
     *
     * @param \Zeteq\MarketBundle\Entity\Store $store
     * @return Product
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
     * Set featured
     *
     * @param boolean $featured
     * @return Product
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
     * Set clearance
     *
     * @param boolean $clearance
     * @return Product
     */
    public function setClearance($clearance)
    {
        $this->clearance = $clearance;
    
        return $this;
    }

    /**
     * Get clearance
     *
     * @return boolean 
     */
    public function getClearance()
    {
        return $this->clearance;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set clearance_price
     *
     * @param boolean $clearancePrice
     * @return Product
     */
    public function setClearancePrice($clearancePrice)
    {
        $this->clearance_price = $clearancePrice;
    
        return $this;
    }

    /**
     * Get clearance_price
     *
     * @return boolean 
     */
    public function getClearancePrice()
    {
        return $this->clearance_price;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
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
     * Set approved
     *
     * @param boolean $approved
     * @return Product
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
     * Add cart_items
     *
     * @param \Zeteq\MarketBundle\Entity\CartItem $cartItems
     * @return Product
     */
    public function addCartItem(\Zeteq\MarketBundle\Entity\CartItem $cartItems)
    {
        $this->cart_items[] = $cartItems;
    
        return $this;
    }

    /**
     * Remove cart_items
     *
     * @param \Zeteq\MarketBundle\Entity\CartItem $cartItems
     */
    public function removeCartItem(\Zeteq\MarketBundle\Entity\CartItem $cartItems)
    {
        $this->cart_items->removeElement($cartItems);
    }

    /**
     * Get cart_items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartItems()
    {
        return $this->cart_items;
    }

    /**
     * Add product_images
     *
     * @param \Zeteq\MarketBundle\Entity\ProductImage $productImages
     * @return Product
     */
    public function addProductImage(\Zeteq\MarketBundle\Entity\ProductImage $productImages)
    {
        $this->product_images[] = $productImages;
    
        return $this;
    }

    /**
     * Remove product_images
     *
     * @param \Zeteq\MarketBundle\Entity\ProductImage $productImages
     */
    public function removeProductImage(\Zeteq\MarketBundle\Entity\ProductImage $productImages)
    {
        $this->product_images->removeElement($productImages);
    }

    /**
     * Get product_images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductImages()
    {
        return $this->product_images;
    }

    /**
     * Set out_of_stock
     *
     * @param boolean $outOfStock
     * @return Product
     */
    public function setOutOfStock($outOfStock)
    {
        $this->out_of_stock = $outOfStock;
    
        return $this;
    }

    /**
     * Get out_of_stock
     *
     * @return boolean 
     */
    public function getOutOfStock()
    {
        return $this->out_of_stock;
    }

    /**
     * Add products_related_to_me
     *
     * @param \Zeteq\MarketBundle\Entity\Product $productsRelatedToMe
     * @return Product
     */
    public function addProductsRelatedToMe(\Zeteq\MarketBundle\Entity\Product $productsRelatedToMe)
    {
        $this->products_related_to_me[] = $productsRelatedToMe;
    
        return $this;
    }

    /**
     * Remove products_related_to_me
     *
     * @param \Zeteq\MarketBundle\Entity\Product $productsRelatedToMe
     */
    public function removeProductsRelatedToMe(\Zeteq\MarketBundle\Entity\Product $productsRelatedToMe)
    {
        $this->products_related_to_me->removeElement($productsRelatedToMe);
    }

    /**
     * Get products_related_to_me
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductsRelatedToMe()
    {
        return $this->products_related_to_me;
    }

    /**
     * Add related_products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $relatedProducts
     * @return Product
     */
    public function addRelatedProduct(\Zeteq\MarketBundle\Entity\Product $relatedProducts)
    {
        $this->related_products[] = $relatedProducts;
    
        return $this;
    }

    /**
     * Remove related_products
     *
     * @param \Zeteq\MarketBundle\Entity\Product $relatedProducts
     */
    public function removeRelatedProduct(\Zeteq\MarketBundle\Entity\Product $relatedProducts)
    {
        $this->related_products->removeElement($relatedProducts);
    }

    /**
     * Get related_products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelatedProducts()
    {
        return $this->related_products;
    }

    /**
     * Set meta_description
     *
     * @param string $metaDescription
     * @return Product
     */
    public function setMetaDescription($metaDescription)
    {
        $this->meta_description = $metaDescription;
    
        return $this;
    }

    /**
     * Get meta_description
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Set meta_keywords
     *
     * @param string $metaKeywords
     * @return Product
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->meta_keywords = $metaKeywords;
    
        return $this;
    }

    /**
     * Get meta_keywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }
}