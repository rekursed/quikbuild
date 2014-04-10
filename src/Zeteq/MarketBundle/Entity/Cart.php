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
 * @ORM\Table(name="cart")
 * @ORM\HasLifecycleCallbacks 
 */
class Cart {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(filterable=false)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\NotBlank(message = "Please provide your first name")
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
     * @ORM\OneToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="cart")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart",cascade={"remove"})
     */
    protected $cart_items;

    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="carts")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id",nullable=false)
     */
    protected $store;

    /**
     * @ORM\ManyToOne(targetEntity="PaymentMethod", inversedBy="carts")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id",nullable=true)
     * @Assert\NotBlank()
     */
    protected $payment_method;

    /**
     * @ORM\ManyToOne(targetEntity="ShippingMethod", inversedBy="carts")
     * @ORM\JoinColumn(name="shipping_method_id", referencedColumnName="id",nullable=true)
     * @Assert\NotBlank()
     */
    protected $shipping_method;

    public function getCount() {

        return $this->getCartItems()->count();
    }

    public function getSubTotal() {

        $st = 0;
        foreach ($this->getCartItems() as $ci) {
            $st += $ci->getTotal();
        }
        return $st;
    }

    public function getShippingCost() {

        return $sm = $this->getShippingMethod()->getCost();
    }

    public function getTotal() {

        return $this->getShippingCost() + $this->getSubTotal();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return 'cart' . $this->getId();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Cart
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Cart
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \Zeteq\UserBundle\Entity\User $user
     * @return Cart
     */
    public function setUser(\Zeteq\UserBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Zeteq\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->cart_items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cart_items
     *
     * @param \Zeteq\MarketBundle\Entity\CartItem $cartItems
     * @return Cart
     */
    public function addCartItem(\Zeteq\MarketBundle\Entity\CartItem $cartItems) {
        $this->cart_items[] = $cartItems;

        return $this;
    }

    /**
     * Remove cart_items
     *
     * @param \Zeteq\MarketBundle\Entity\CartItem $cartItems
     */
    public function removeCartItem(\Zeteq\MarketBundle\Entity\CartItem $cartItems) {
        $this->cart_items->removeElement($cartItems);
    }

    /**
     * Get cart_items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartItems() {
        return $this->cart_items;
    }

    /**
     * Set billing_first_name
     *
     * @param string $billingFirstName
     * @return Cart
     */
    public function setBillingFirstName($billingFirstName) {
        $this->billing_first_name = $billingFirstName;

        return $this;
    }

    /**
     * Get billing_first_name
     *
     * @return string 
     */
    public function getBillingFirstName() {
        return $this->billing_first_name;
    }

    /**
     * Set billing_last_name
     *
     * @param string $billingLastName
     * @return Cart
     */
    public function setBillingLastName($billingLastName) {
        $this->billing_last_name = $billingLastName;

        return $this;
    }

    /**
     * Get billing_last_name
     *
     * @return string 
     */
    public function getBillingLastName() {
        return $this->billing_last_name;
    }

    /**
     * Set billing_email
     *
     * @param string $billingEmail
     * @return Cart
     */
    public function setBillingEmail($billingEmail) {
        $this->billing_email = $billingEmail;

        return $this;
    }

    /**
     * Get billing_email
     *
     * @return string 
     */
    public function getBillingEmail() {
        return $this->billing_email;
    }

    /**
     * Set billing_address
     *
     * @param string $billingAddress
     * @return Cart
     */
    public function setBillingAddress($billingAddress) {
        $this->billing_address = $billingAddress;

        return $this;
    }

    /**
     * Get billing_address
     *
     * @return string 
     */
    public function getBillingAddress() {
        return $this->billing_address;
    }

    /**
     * Set billing_city
     *
     * @param string $billingCity
     * @return Cart
     */
    public function setBillingCity($billingCity) {
        $this->billing_city = $billingCity;

        return $this;
    }

    /**
     * Get billing_city
     *
     * @return string 
     */
    public function getBillingCity() {
        return $this->billing_city;
    }

    /**
     * Set billing_state
     *
     * @param string $billingState
     * @return Cart
     */
    public function setBillingState($billingState) {
        $this->billing_state = $billingState;

        return $this;
    }

    /**
     * Get billing_state
     *
     * @return string 
     */
    public function getBillingState() {
        return $this->billing_state;
    }

    /**
     * Set billing_postalcode
     *
     * @param string $billingPostalcode
     * @return Cart
     */
    public function setBillingPostalcode($billingPostalcode) {
        $this->billing_postalcode = $billingPostalcode;

        return $this;
    }

    /**
     * Get billing_postalcode
     *
     * @return string 
     */
    public function getBillingPostalcode() {
        return $this->billing_postalcode;
    }

    /**
     * Set billing_country
     *
     * @param string $billingCountry
     * @return Cart
     */
    public function setBillingCountry($billingCountry) {
        $this->billing_country = $billingCountry;

        return $this;
    }

    /**
     * Get billing_country
     *
     * @return string 
     */
    public function getBillingCountry() {
        return $this->billing_country;
    }

    /**
     * Set billing_phone
     *
     * @param string $billingPhone
     * @return Cart
     */
    public function setBillingPhone($billingPhone) {
        $this->billing_phone = $billingPhone;

        return $this;
    }

    /**
     * Get billing_phone
     *
     * @return string 
     */
    public function getBillingPhone() {
        return $this->billing_phone;
    }

    /**
     * Set shipping_first_name
     *
     * @param string $shippingFirstName
     * @return Cart
     */
    public function setShippingFirstName($shippingFirstName) {

        $this->shipping_first_name = $shippingFirstName;

        return $this;
    }

    /**
     * Get shipping_first_name
     *
     * @return string 
     */
    public function getShippingFirstName() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingFirstName();
        }

        return $this->shipping_first_name;
    }

    /**
     * Set shipping_last_name
     *
     * @param string $shippingLastName
     * @return Cart
     */
    public function setShippingLastName($shippingLastName) {
        $this->shipping_last_name = $shippingLastName;

        return $this;
    }

    /**
     * Get shipping_last_name
     *
     * @return string 
     */
    public function getShippingLastName() {

        if ($this->getShippingBillingSame()) {

            return $this->getBillingLastName();
        }
        return $this->shipping_last_name;
    }

    /**
     * Set shipping_email
     *
     * @param string $shippingEmail
     * @return Cart
     */
    public function setShippingEmail($shippingEmail) {
        $this->shipping_email = $shippingEmail;

        return $this;
    }

    /**
     * Get shipping_email
     *
     * @return string 
     */
    public function getShippingEmail() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingEmail();
        }
        return $this->shipping_email;
    }

    /**
     * Set shipping_address
     *
     * @param string $shippingAddress
     * @return Cart
     */
    public function setShippingAddress($shippingAddress) {
        $this->shipping_address = $shippingAddress;

        return $this;
    }

    /**
     * Get shipping_address
     *
     * @return string 
     */
    public function getShippingAddress() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingAddress();
        }
        return $this->shipping_address;
    }

    /**
     * Set shipping_city
     *
     * @param string $shippingCity
     * @return Cart
     */
    public function setShippingCity($shippingCity) {
        $this->shipping_city = $shippingCity;

        return $this;
    }

    /**
     * Get shipping_city
     *
     * @return string 
     */
    public function getShippingCity() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingCity();
        }
        return $this->shipping_city;
    }

    /**
     * Set shipping_state
     *
     * @param string $shippingState
     * @return Cart
     */
    public function setShippingState($shippingState) {
        $this->shipping_state = $shippingState;

        return $this;
    }

    /**
     * Get shipping_state
     *
     * @return string 
     */
    public function getShippingState() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingState();
        }
        return $this->shipping_state;
    }

    /**
     * Set shipping_postalcode
     *
     * @param string $shippingPostalcode
     * @return Cart
     */
    public function setShippingPostalcode($shippingPostalcode) {
        $this->shipping_postalcode = $shippingPostalcode;

        return $this;
    }

    /**
     * Get shipping_postalcode
     *
     * @return string 
     */
    public function getShippingPostalcode() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingPostalcode();
        }
        return $this->shipping_postalcode;
    }

    /**
     * Set shipping_country
     *
     * @param string $shippingCountry
     * @return Cart
     */
    public function setShippingCountry($shippingCountry) {
        $this->shipping_country = $shippingCountry;

        return $this;
    }

    /**
     * Get shipping_country
     *
     * @return string 
     */
    public function getShippingCountry() {

        if ($this->getShippingBillingSame()) {

            return $this->getBillingCountry();
        }


        return $this->shipping_country;
    }

    /**
     * Set shipping_phone
     *
     * @param string $shippingPhone
     * @return Cart
     */
    public function setShippingPhone($shippingPhone) {
        $this->shipping_phone = $shippingPhone;

        return $this;
    }

    /**
     * Get shipping_phone
     *
     * @return string 
     */
    public function getShippingPhone() {
        if ($this->getShippingBillingSame()) {

            return $this->getBillingPhone();
        }
        return $this->shipping_phone;
    }

    /**
     * Set shipping_billing_same
     *
     * @param boolean $shippingBillingSame
     * @return Cart
     */
    public function setShippingBillingSame($shippingBillingSame) {
        $this->shipping_billing_same = $shippingBillingSame;

        return $this;
    }

    /**
     * Get shipping_billing_same
     *
     * @return boolean 
     */
    public function getShippingBillingSame() {

        return $this->shipping_billing_same;
    }

    /**
     * Set payment_method
     *
     * @param \Zeteq\MarketBundle\Entity\PaymentMethod $paymentMethod
     * @return Cart
     */
    public function setPaymentMethod(\Zeteq\MarketBundle\Entity\PaymentMethod $paymentMethod = null) {
        $this->payment_method = $paymentMethod;

        return $this;
    }

    /**
     * Get payment_method
     *
     * @return \Zeteq\MarketBundle\Entity\PaymentMethod 
     */
    public function getPaymentMethod() {
        return $this->payment_method;
    }

    /**
     * Set shipping_method
     *
     * @param \Zeteq\MarketBundle\Entity\ShippingMethod $shippingMethod
     * @return Cart
     */
    public function setShippingMethod(\Zeteq\MarketBundle\Entity\ShippingMethod $shippingMethod = null) {
        $this->shipping_method = $shippingMethod;

        return $this;
    }

    /**
     * Get shipping_method
     *
     * @return \Zeteq\MarketBundle\Entity\ShippingMethod 
     */
    public function getShippingMethod() {
        return $this->shipping_method;
    }

    /**
     * Set store
     *
     * @param \Zeteq\MarketBundle\Entity\Store $store
     * @return Cart
     */
    public function setStore(\Zeteq\MarketBundle\Entity\Store $store) {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \Zeteq\MarketBundle\Entity\Store 
     */
    public function getStore() {
        return $this->store;
    }

}