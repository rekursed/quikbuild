<?php 


namespace Zeteq\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="homeslide_image")
 * @ORM\HasLifecycleCallbacks 
 */


class HomeSlideImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


 
    
    /**
     * @ORM\Column(type="string",length=128, nullable=true)
     */
    protected $name;

 
        /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $sort;
    
    

   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $enabled;


     
     /**
     * @ORM\Column(type="text",  nullable=true)
     */
    protected $body;
    
    /**
     * @ORM\ManyToMany(targetEntity="HomeSlideGallery",mappedBy="images")
     *
     */
    protected $galleries;
  


    //////////image uploading begin
    
    

 /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $image_path;
    
    /**
     * @var string $image
     * @Assert\File( maxSize = "5024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $image;
    
    
public function getWebPath() 
{
        return  'upload/images/'. $this->image_path;
}
    

public function getFullImagePath() 
{
return   $this->getUploadRootDir(). $this->image_path;
}
 
protected function getUploadRootDir() 
{
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../public_html/upload/images/';
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
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return HomeSlideImage
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
     * Set sort
     *
     * @param integer $sort
     * @return HomeSlideImage
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    
        return $this;
    }

    /**
     * Get sort
     *
     * @return integer 
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return HomeSlideImage
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
     * Set body
     *
     * @param string $body
     * @return HomeSlideImage
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set image_path
     *
     * @param string $imagePath
     * @return HomeSlideImage
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
     * @return HomeSlideImage
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
     * Add galleries
     *
     * @param \Zeteq\FrontBundle\Entity\HomeSlideGallery $galleries
     * @return HomeSlideImage
     */
    public function addGallerie(\Zeteq\FrontBundle\Entity\HomeSlideGallery $galleries)
    {
        $this->galleries[] = $galleries;
    
        return $this;
    }

    /**
     * Remove galleries
     *
     * @param \Zeteq\FrontBundle\Entity\HomeSlideGallery $galleries
     */
    public function removeGallerie(\Zeteq\FrontBundle\Entity\HomeSlideGallery $galleries)
    {
        $this->galleries->removeElement($galleries);
    }

    /**
     * Get galleries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGalleries()
    {
        return $this->galleries;
    }
}