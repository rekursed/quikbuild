<?php

namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @ORM\Table(name="favorite_stores")
 * @ORM\HasLifecycleCallbacks 
 */
class FavoriteStore {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Zeteq\UserBundle\Entity\User", inversedBy="FavoriteStores")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="favorite_stores")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     */
    private $store;
    
   

    public function __toString() {
        return $this->getName();
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
     * Set user
     *
     * @param \Zeteq\UserBundle\Entity\User $user
     * @return FavoriteStore
     */
    public function setUser(\Zeteq\UserBundle\Entity\User $user)
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
     * Set store
     *
     * @param \Zeteq\MarketBundle\Entity\Store $store
     * @return FavoriteStore
     */
    public function setStore(\Zeteq\MarketBundle\Entity\Store $store = null)
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
}