<?php

namespace App\Controller;

use App\Entity\Car;
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
            'car'=>$car
        ]);
    }

    /**
     * @Route("/",name="parts")
     */
    public function parts(Request $request)
    {
        /** @var Car $car */
        $car = $this->get(CarService::class)->repo()->find($request->query->getInt('car_id'));
        $type = $this->get(PartTypeService::class)->repo()->find($request->query->getInt('type_id'));
        return $this->render('part/parts.html.twig', [
            'parts' => $this->get(PartService::class)->repo()->findBy([
                'type'=>$type,
                'car'=>$car,
                'isActive'=>true,
            ]),
            'title' => 'Каталог',
            'car'=>$car
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
        if($ids){
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
