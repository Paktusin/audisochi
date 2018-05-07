<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Entity\ServiceCar;
use App\Service;

class ServiceCarService extends Service
{
    protected $class = ServiceCar::class;
}