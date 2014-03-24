<?php 
// src/Acme/UserBundle/Entity/User.php
namespace Zeteq\UserBundle\Entity;

use Zeteq\MarketBundle\Entity\Store;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\MarketBundle\Entity\Customer;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Zeteq\UserBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Zeteq\UserBundle\Entity\UserRepository")
 * @UniqueEntity(fields="email", message="Sorry, this email address is already in use.")
 * 
 */

class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(filterable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=false, nullable=true)
     */
    private $username;
    
         /**
     * @ORM\Column(type="string", length=225,nullable=true)
     */
    private $activation_code;    

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=64)
     * 
     * @Assert\Length(
     *      min = "8",
     *      max = "15",
     *      minMessage = "Password  must be at least {{ limit }} characters length",
     *      maxMessage = "Password cannot be longer than {{ limit }} characters length"
     * )
     * 
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=60, unique=true)
     *   @GRID\Column(operatorsVisible=false)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
       /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;
    
          /**
     * @ORM\OneToMany(targetEntity="Zeteq\MarketBundle\Entity\Store", mappedBy="user",cascade={"persist"})
     */
    protected $stores;
    
        
    /**
     * @ORM\OneToOne(targetEntity="Zeteq\MarketBundle\Entity\Cart", mappedBy="user")
     */
    private $cart;
    
            
    /**
     * @ORM\OneToOne(targetEntity="Zeteq\MarketBundle\Entity\Customer", mappedBy="user")
     */
    private $customer;
    

    public function __toString()
    {
        return $this->email;
    }
    
        public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
          $this->roles = new ArrayCollection();
    }

    
    
    
    
    
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {

        return $this->roles->toArray();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add roles
     *
     * @param \Zeteq\UserBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Zeteq\UserBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Zeteq\UserBundle\Entity\Role $roles
     */
    public function removeRole(\Zeteq\UserBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Set activation_code
     *
     * @param string $activationCode
     * @return User
     */
    public function setActivationCode($activationCode)
    {
        $this->activation_code = $activationCode;
    
        return $this;
    }

    /**
     * Get activation_code
     *
     * @return string 
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }



    /**
     * Add stores
     *
     * @param \Zeteq\MarketBundle\Entity\Store $stores
     * @return User
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
     * Set cart
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $cart
     * @return User
     */
    public function setCart(\Zeteq\MarketBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;
    
        return $this;
    }

    /**
     * Get cart
     *
     * @return \Zeteq\MarketBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set customer
     *
     * @param \Zeteq\MarketBundle\Entity\Cart $customer
     * @return User
     */
    public function setCustomer(\Zeteq\MarketBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return \Zeteq\MarketBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}