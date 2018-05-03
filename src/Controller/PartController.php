<?php

namespace App\Controller;

use App\Service\PartService;
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
     * @Route("/",name="part_index")
     */
    public function index(Request $request)
    {
        return $this->render('part/index.html.twig', [
            'parts' => $this->get(PartService::class)->repo()->findAll(),
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
