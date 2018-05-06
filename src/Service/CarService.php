<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Entity\Car;
use App\Service;
use Doctrine\ORM\QueryBuilder;

class CarService extends Service
{
    protected $class = Car::class;

    public function findOrCreate($brand, $model)
    {
        $car = $this->repo->findOneBy(['brand' => $brand, 'model' => $model]);
        if (!$car) {
            $car = new Car();
            $car->setBrand($brand);
            $car->setModel($model);
            $this->em->persist($car);
            $this->em->flush();
        }
        return $car;
    }

    /**
     * @return Car[]
     */
    public function forMenu()
    {
        /** @var QueryBuilder $q */
        $q = $this->repo->createQueryBuilder('c');
        return $q
            ->innerJoin('c.parts', 'p')
            ->innerJoin('p.type', 't')
            ->andWhere('p.isActive = true')
            ->getQuery()
            ->getResult();

    }
}