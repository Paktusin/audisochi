<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Entity\Part;
use App\Service;

class CommonService extends Service
{
    public function getBrands()
    {
        return $this->container->getParameter('brands');
    }
}