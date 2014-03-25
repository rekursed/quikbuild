<?php 


namespace Zeteq\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="homeslide_gallery")
  */


class HomeSlideGallery
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


  
    
    /**
     * @ORM\Column(type="string",length=300, nullable=false)
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
    protected $home_slide;    
    

   /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $enabled;


    /**
     * @ORM\ManyToMany(targetEntity="HomeSlideImage", inversedBy="gallerys" ,cascade={"persist","remove"})
     *
     */
    protected $images;
   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return $this->name;
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
     * @return HomeSlideGallery
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
     * Set slug
     *
     * @param string $slug
     * @return HomeSlideGallery
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
     * Set home_slide
     *
     * @param boolean $homeSlide
     * @return HomeSlideGallery
     */
    public function setHomeSlide($homeSlide)
    {
        $this->home_slide = $homeSlide;
    
        return $this;
    }

    /**
     * Get home_slide
     *
     * @return boolean 
     */
    public function getHomeSlide()
    {
        return $this->home_slide;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return HomeSlideGallery
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
     * Add images
     *
     * @param \Zeteq\FrontBundle\Entity\HomeSlideImage $images
     * @return HomeSlideGallery
     */
    public function addImage(\Zeteq\FrontBundle\Entity\HomeSlideImage $images)
    {
        $this->images[] = $images;
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \Zeteq\FrontBundle\Entity\HomeSlideImage $images
     */
    public function removeImage(\Zeteq\FrontBundle\Entity\HomeSlideImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}