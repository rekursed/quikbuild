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
 * @ORM\Table(name="payment_method")
 * @ORM\HasLifecycleCallbacks 
 */
class PaymentMethod
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
      * @GRID\Column(filterable=false)
     */
    protected $id;
    
 




               /**
     * @ORM\Column(type="string", length=150,  nullable=true)
     */
    protected $name;
    
    
                   /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    
    
            /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="payment_method",cascade={"persist"})
     */
    protected $carts;
    
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
     * @return PaymentMethod
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
     * Constructor
     */
    public function __construct()
    {
        $this->carts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add carts
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $carts
     * @return PaymentMethod
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
     * Set description
     *
     * @param string $description
     * @return PaymentMethod
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
}