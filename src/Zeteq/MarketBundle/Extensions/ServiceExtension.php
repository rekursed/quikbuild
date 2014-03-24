<?php
namespace Zeteq\MarketBundle\Extensions;

use  Zeteq\MarketBundle\Extensions\Service;

class ServiceExtension extends \Twig_Extension
{
    protected $service;

    function __construct(Service $service) {
        $this->service = $service;
    }

    public function getGlobals() {
        return array(
            'service' => $this->service
        );
    }

    public function getName()
    {
        return 'service';
    }

}
