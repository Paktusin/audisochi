<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Part;
use App\Entity\PartType;
use App\Service\CarService;
use App\Service\PartService;
use App\Service\PartTypeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("part")
 */
class PartController extends Controller
{

    /**
     * @Route("/cars",name="part_index")
     */
    public function index(Request $request)
    {
        return $this->render('part/index.html.twig', [
            'cars' => $this->get(CarService::class)->forMenu(),
            'title' => 'Запасные части',
            'banner' => [
                'image' => 'https://i.imgur.com/a4kt8MT.jpg',
                'body' => '
                <h2 class="a-header arrow">Запасные части</h2>
                <h2 class="a-header arrow">Аксессуары</h2>
                <h2 class="a-header arrow">Сочи</h2>
                ',
                'video' => 'https://www.audi.de/content/dam/nemo/customer-area/servicing-your-audi/audi-genuine-parts/video/new-ci/1920x1080_audi_agp_perfect_fit_2010_new_ending_42sec_ger.mp4'
            ]
        ]);
    }

    /**
     * @Route("/types",name="part_types")
     */
    public function types(Request $request)
    {
        /** @var Car $car */
        $car = $this->get(CarService::class)->repo()->find($request->query->getInt('car_id'));
        return $this->render('part/types.html.twig', [
            'types' => $this->get(PartTypeService::class)->getMenu($car),
            'title' => 'Каталог',
            'car' => $car,
            'bread' => [
                ['url' => $this->get('router')->generate('part_index'), 'name' => 'Запчасти'],
                ['name' => $car->getFullName()],
            ]
        ]);
    }

    /**
     * @Route("/",name="parts")
     */
    public function parts(Request $request)
    {
        /** @var Car $car */
        $car = $this->get(CarService::class)->repo()->find($request->query->getInt('car_id'));
        if (!$car) return $this->createNotFoundException('Автомобиль не найден');
        /** @var PartType $type */
        $type = $this->get(PartTypeService::class)->repo()->find($request->query->getInt('type_id'));
        if (!$type) return $this->createNotFoundException('Категоря не найдена');
        return $this->render('part/parts.html.twig', [
            'parts' => $this->get(PartService::class)->repo()->findBy([
                'type' => $type,
                'car' => $car,
                'isActive' => true,
            ]),
            'title' => 'Каталог',
            'car' => $car,
            'bread' => [
                ['url' => $this->get('router')->generate('part_index'), 'name' => 'Запчасти'],
                ['url' => $this->get('router')->generate('part_types', ['car_id' => $car->getId()]), 'name' => $car->getFullName()],
                ['name' => $type->getName()],
            ]
        ]);
    }


    /**
     * @Route("/show/{id}",name="part_show")
     */
    public function show(Request $request, $id)
    {
        /** @var Part $part */
        $part = $this->get(PartService::class)->repo()->find($id);
        if (!$part) return $this->createNotFoundException('Запчасть не найдена');
        return $this->render('part/show.html.twig', [
            'part' => $part,
            'title' => $part->getName() . ' для ' . $part->getCar()->getFullName(),
            'bread' => [
                ['url' => $this->get('router')->generate('part_index'), 'name' => 'Запчасти'],
                ['url' => $this->get('router')->generate('part_types', ['car_id' => $part->getCar()->getId()]), 'name' => $part->getCar()->getFullName()],
                ['url' => $this->get('router')->generate('parts', ['type_id' => $part->getType()->getId(), 'car_id' => $part->getCar()->getId()]), 'name' => $part->getType()->getName()],
                ['name' => $part->getName()]
            ]
        ]);
    }

    /**
     * @Route("/order")
     * @Method("POST")
     */
    public function order(Request $request)
    {
        $counts = [];
        $parts = [];
        $ids = $request->request->get('ids');
        if ($ids) {
            foreach ($ids as $id) {
                if (isset($counts[$id])) $counts[$id]++;
                else $counts[$id] = 1;
            }
            $parts = $this->get(PartService::class)->repo()->findBy(['id' => $ids]);
        }
        return $this->render('/part/order.html.twig', [
            'parts' => $parts,
            'counts' => $counts
        ]);
    }

}
