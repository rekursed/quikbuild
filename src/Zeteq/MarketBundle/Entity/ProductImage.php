<?php 


namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_image")
 * @ORM\HasLifecycleCallbacks
  */
class ProductImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(filterable=false)
     */
    protected $id;
    

    

     /**
     * @ORM\Column(type="string",length=130,  nullable=true)
      *   @GRID\Column(operatorsVisible=false)
     */
    protected $name;
         
      
     /**
     * @ORM\Column(type="text",  nullable=true)
     */
    protected $description;
    
 
    
    /**
     * @ORM\ManyToMany(targetEntity="Product",mappedBy="route_parameters")
     *
     */

   protected $products;
    
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
        return  'upload/product/images/'. $this->image_path;
}
    

public function getFullImagePath() 
{
return   $this->getUploadRootDir(). $this->image_path;
}
 
protected function getUploadRootDir() 
{
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../public_html/upload/product/images/';
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
     * @return ProductImage
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
     * Set description
     *
     * @param string $description
     * @return ProductImage
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
     * @return ProductImage
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
     * @return ProductImage
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
     * Set product
     *
     * @param \Zeteq\MarketBundle\Entity\Product $product
     * @return ProductImage
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
     * @return ProductImage
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
}