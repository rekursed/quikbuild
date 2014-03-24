<?php

namespace Zeteq\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\ORM\EntityRepository;


class StoreProductCategoryRepository extends EntityRepository
{
    public function findByStore($store)
    {
      return  $query = $this->createQueryBuilder('u')
                          ->select('u')
                            ->where('u.store = :store')
                         ->setParameter('store', $store);
        
        
  
      
    }
}
