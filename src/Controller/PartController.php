<?php

namespace App\Controller;

use App\Service\PartService;
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
    public function index()
    {
        return $this->render('part/index.html.twig', [
            'parts'=>$this->get(PartService::class)->repo()->findAll(),
            'title' => 'Запасные части',
            'banner' => [
                'image' => 'https://i.imgur.com/a4kt8MT.jpg',
                'body'=>'
                <h2 class="a-header arrow">Запасные части</h2>
                <h2 class="a-header arrow">Аксессуары</h2>
                <h2 class="a-header arrow">Сочи</h2>
                ',
                'video' => 'https://www.audi.de/content/dam/nemo/customer-area/servicing-your-audi/audi-genuine-parts/video/new-ci/1920x1080_audi_agp_perfect_fit_2010_new_ending_42sec_ger.mp4'
            ]
        ]);
    }
}
