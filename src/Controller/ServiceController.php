<?php

namespace App\Controller;

use App\Service\ServiceCarService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("service")
 */
class ServiceController extends Controller
{
    /**
     * @Route("/", name="service")
     */
    public function index()
    {
//        $services = [
//            ['image' => 'https://i.imgur.com/S6AxaXh.jpg', 'name' => 'Компьютерная диагностика'],
//            ['image' => 'https://i.imgur.com/PYuamR2.jpg', 'name' => 'Сервисное обслуживание и ТО'],
//            ['image' => 'https://i.imgur.com/LJ4eqpY.jpg', 'name' => 'Диагностика ходовой'],
//        ];
        return $this->render('service/index.html.twig', [
            'banner' => [
                'image' => 'https://imgur.com/nXi0gDs.jpg',
                'body' => '
                <h2 class="arrow a-header">Диагностика</h2>
                <h2 class="arrow a-header">Сервисное обслуживание</h2>
                <h2 class="arrow a-header">Сочи</h2>
                <h2 class="arrow a-header"><a href="/ticket/service">Записаться на прием</a></h2>
                '
            ],
            'services' => $this->get(ServiceCarService::class)->repo()->findAll()
        ]);
    }
}
