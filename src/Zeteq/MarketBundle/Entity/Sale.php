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
 * @ORM\Table(name="sale")
 * @ORM\HasLifecycleCallbacks 
 */
class Sale
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
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $order_number;
    
         /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $payment_method;
    
         /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_method;
    
         /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_cost;
    
         /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $total;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="cart")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    
         /**
     * @ORM\OneToMany(targetEntity="SaleItem", mappedBy="sale",cascade={"persist"})
     */
    protected $sale_items;
     
     /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_first_name;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_last_name;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $billing_address;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $billing_city;
     
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_state;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_postalcode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $billing_country;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billing_phone;



    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_first_name;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_last_name;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $shipping_address;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $shipping_city;
     
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_state;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_postalcode;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $shipping_country;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $shipping_phone;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $shipping_billing_same;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $is_shipped;

        /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $is_viewed;
    
    
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
        return 'cart'.$this->getId();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Cart
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
     * @return Cart
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
     * Set user
     *
     * @param \Zeteq\UserBundle\Entity\User $user
     * @return Cart
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
     * Constructor
     */
    public function __construct()
    {
        $this->cart_items = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add cart_items
     *
     * @param \Zeteq\MarketBundle\Entity\CartItem $cartItems
     * @return Cart
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
     * Set billing_first_name
     *
     * @param string $billingFirstName
     * @return Sale
     */
    public function setBillingFirstName($billingFirstName)
    {
        $this->billing_first_name = $billingFirstName;
    
        return $this;
    }

    /**
     * Get billing_first_name
     *
     * @return string 
     */
    public function getBillingFirstName()
    {
        return $this->billing_first_name;
    }

    /**
     * Set billing_last_name
     *
     * @param string $billingLastName
     * @return Sale
     */
    public function setBillingLastName($billingLastName)
    {
        $this->billing_last_name = $billingLastName;
    
        return $this;
    }

    /**
     * Get billing_last_name
     *
     * @return string 
     */
    public function getBillingLastName()
    {
        return $this->billing_last_name;
    }

    /**
     * Set billing_email
     *
     * @param string $billingEmail
     * @return Sale
     */
    public function setBillingEmail($billingEmail)
    {
        $this->billing_email = $billingEmail;
    
        return $this;
    }

    /**
     * Get billing_email
     *
     * @return string 
     */
    public function getBillingEmail()
    {
        return $this->billing_email;
    }

    /**
     * Set billing_address
     *
     * @param string $billingAddress
     * @return Sale
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billing_address = $billingAddress;
    
        return $this;
    }

    /**
     * Get billing_address
     *
     * @return string 
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * Set billing_city
     *
     * @param string $billingCity
     * @return Sale
     */
    public function setBillingCity($billingCity)
    {
        $this->billing_city = $billingCity;
    
        return $this;
    }

    /**
     * Get billing_city
     *
     * @return string 
     */
    public function getBillingCity()
    {
        return $this->billing_city;
    }

    /**
     * Set billing_state
     *
     * @param string $billingState
     * @return Sale
     */
    public function setBillingState($billingState)
    {
        $this->billing_state = $billingState;
    
        return $this;
    }

    /**
     * Get billing_state
     *
     * @return string 
     */
    public function getBillingState()
    {
        return $this->billing_state;
    }

    /**
     * Set billing_postalcode
     *
     * @param string $billingPostalcode
     * @return Sale
     */
    public function setBillingPostalcode($billingPostalcode)
    {
        $this->billing_postalcode = $billingPostalcode;
    
        return $this;
    }

    /**
     * Get billing_postalcode
     *
     * @return string 
     */
    public function getBillingPostalcode()
    {
        return $this->billing_postalcode;
    }

    /**
     * Set billing_country
     *
     * @param string $billingCountry
     * @return Sale
     */
    public function setBillingCountry($billingCountry)
    {
        $this->billing_country = $billingCountry;
    
        return $this;
    }

    /**
     * Get billing_country
     *
     * @return string 
     */
    public function getBillingCountry()
    {
        return $this->billing_country;
    }

    /**
     * Set billing_phone
     *
     * @param string $billingPhone
     * @return Sale
     */
    public function setBillingPhone($billingPhone)
    {
        $this->billing_phone = $billingPhone;
    
        return $this;
    }

    /**
     * Get billing_phone
     *
     * @return string 
     */
    public function getBillingPhone()
    {
        return $this->billing_phone;
    }

    /**
     * Set shipping_first_name
     *
     * @param string $shippingFirstName
     * @return Sale
     */
    public function setShippingFirstName($shippingFirstName)
    {
        $this->shipping_first_name = $shippingFirstName;
    
        return $this;
    }

    /**
     * Get shipping_first_name
     *
     * @return string 
     */
    public function getShippingFirstName()
    {
        return $this->shipping_first_name;
    }

    /**
     * Set shipping_last_name
     *
     * @param string $shippingLastName
     * @return Sale
     */
    public function setShippingLastName($shippingLastName)
    {
        $this->shipping_last_name = $shippingLastName;
    
        return $this;
    }

    /**
     * Get shipping_last_name
     *
     * @return string 
     */
    public function getShippingLastName()
    {
        return $this->shipping_last_name;
    }

    /**
     * Set shipping_email
     *
     * @param string $shippingEmail
     * @return Sale
     */
    public function setShippingEmail($shippingEmail)
    {
        $this->shipping_email = $shippingEmail;
    
        return $this;
    }

    /**
     * Get shipping_email
     *
     * @return string 
     */
    public function getShippingEmail()
    {
        return $this->shipping_email;
    }

    /**
     * Set shipping_address
     *
     * @param string $shippingAddress
     * @return Sale
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shipping_address = $shippingAddress;
    
        return $this;
    }

    /**
     * Get shipping_address
     *
     * @return string 
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Set shipping_city
     *
     * @param string $shippingCity
     * @return Sale
     */
    public function setShippingCity($shippingCity)
    {
        $this->shipping_city = $shippingCity;
    
        return $this;
    }

    /**
     * Get shipping_city
     *
     * @return string 
     */
    public function getShippingCity()
    {
        return $this->shipping_city;
    }

    /**
     * Set shipping_state
     *
     * @param string $shippingState
     * @return Sale
     */
    public function setShippingState($shippingState)
    {
        $this->shipping_state = $shippingState;
    
        return $this;
    }

    /**
     * Get shipping_state
     *
     * @return string 
     */
    public function getShippingState()
    {
        return $this->shipping_state;
    }

    /**
     * Set shipping_postalcode
     *
     * @param string $shippingPostalcode
     * @return Sale
     */
    public function setShippingPostalcode($shippingPostalcode)
    {
        $this->shipping_postalcode = $shippingPostalcode;
    
        return $this;
    }

    /**
     * Get shipping_postalcode
     *
     * @return string 
     */
    public function getShippingPostalcode()
    {
        return $this->shipping_postalcode;
    }

    /**
     * Set shipping_country
     *
     * @param string $shippingCountry
     * @return Sale
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->shipping_country = $shippingCountry;
    
        return $this;
    }

    /**
     * Get shipping_country
     *
     * @return string 
     */
    public function getShippingCountry()
    {
        return $this->shipping_country;
    }

    /**
     * Set shipping_phone
     *
     * @param string $shippingPhone
     * @return Sale
     */
    public function setShippingPhone($shippingPhone)
    {
        $this->shipping_phone = $shippingPhone;
    
        return $this;
    }

    /**
     * Get shipping_phone
     *
     * @return string 
     */
    public function getShippingPhone()
    {
        return $this->shipping_phone;
    }

    /**
     * Set shipping_billing_same
     *
     * @param boolean $shippingBillingSame
     * @return Sale
     */
    public function setShippingBillingSame($shippingBillingSame)
    {
        $this->shipping_billing_same = $shippingBillingSame;
    
        return $this;
    }

    /**
     * Get shipping_billing_same
     *
     * @return boolean 
     */
    public function getShippingBillingSame()
    {
        return $this->shipping_billing_same;
    }

    /**
     * Add sale_items
     *
     * @param \Zeteq\MarketBundle\Entity\SaleItem $saleItems
     * @return Sale
     */
    public function addSaleItem(\Zeteq\MarketBundle\Entity\SaleItem $saleItems)
    {
        $this->sale_items[] = $saleItems;
    
        return $this;
    }

    /**
     * Remove sale_items
     *
     * @param \Zeteq\MarketBundle\Entity\SaleItem $saleItems
     */
    public function removeSaleItem(\Zeteq\MarketBundle\Entity\SaleItem $saleItems)
    {
        $this->sale_items->removeElement($saleItems);
    }

    /**
     * Get sale_items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSaleItems()
    {
        return $this->sale_items;
    }

    /**
     * Set order_number
     *
     * @param string $orderNumber
     * @return Sale
     */
    public function setOrderNumber($orderNumber)
    {
        $this->order_number = $orderNumber;
    
        return $this;
    }

    /**
     * Get order_number
     *
     * @return string 
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * Set payment_method
     *
     * @param string $paymentMethod
     * @return Sale
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->payment_method = $paymentMethod;
    
        return $this;
    }

    /**
     * Get payment_method
     *
     * @return string 
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Set shipping_method
     *
     * @param string $shippingMethod
     * @return Sale
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shipping_method = $shippingMethod;
    
        return $this;
    }

    /**
     * Get shipping_method
     *
     * @return string 
     */
    public function getShippingMethod()
    {
        return $this->shipping_method;
    }

    /**
     * Set shipping_cost
     *
     * @param string $shippingCost
     * @return Sale
     */
    public function setShippingCost($shippingCost)
    {
        $this->shipping_cost = $shippingCost;
    
        return $this;
    }

    /**
     * Get shipping_cost
     *
     * @return string 
     */
    public function getShippingCost()
    {
        return $this->shipping_cost;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Sale
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set is_shipped
     *
     * @param boolean $isShipped
     * @return Sale
     */
    public function setIsShipped($isShipped)
    {
        $this->is_shipped = $isShipped;
    
        return $this;
    }

    /**
     * Get is_shipped
     *
     * @return boolean 
     */
    public function getIsShipped()
    {
        return $this->is_shipped;
    }

    /**
     * Set is_viewed
     *
     * @param boolean $isViewed
     * @return Sale
     */
    public function setIsViewed($isViewed)
    {
        $this->is_viewed = $isViewed;
    
        return $this;
    }

    /**
     * Get is_viewed
     *
     * @return boolean 
     */
    public function getIsViewed()
    {
        return $this->is_viewed;
    }
}