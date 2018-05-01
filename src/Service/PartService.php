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

class PartService extends Service
{
    protected $class = Part::class;
}