<?php 

// src/Demo/DemoBundle/Site/SiteManager.php
namespace Zeteq\MarketBundle\Extensions;
 
class SiteManager
{
    private $currentSite;
 
    public function getCurrentSite()
    {
        return $this->currentSite;
    }
 
    public function setCurrentSite($currentSite)
    {
        $this->currentSite = $currentSite;
    }
}
