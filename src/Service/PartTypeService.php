<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Entity\Car;
use App\Entity\PartType;
use App\Service;

class PartTypeService extends Service
{
    protected $class = PartType::class;

    public function findOrCreate($name, $substr = null)
    {
        if ($substr) {
            $s_name = mb_substr($name, 0, $substr);
            $type = $this->repo->createQueryBuilder('t')->andWhere("t.name LIKE '{$s_name}%'")
                    ->getQuery()->getOneOrNullResult();
        } else {
            $type = $this->repo->findOneBy(['name' => $name]);
        }
        if (!$type) {
            $type = new PartType();
            $type->setName($name);
            $this->em->persist($type);
            $this->em->flush();
        }
        return $type;
    }

    /**
     * @param Car $car
     * @return PartType[]
     */
    public function getMenu(Car $car){
        return $this->q
            ->innerJoin('e.parts','p')
            ->innerJoin('p.car','c')
            ->andWhere('c.id = :car_id')
            ->andWhere('p.isActive = true')
            ->setParameter('car_id',$car->getId())
            ->getQuery()
            ->getResult();
    }

}