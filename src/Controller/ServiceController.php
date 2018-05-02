<?php

namespace App\Controller;

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
        return $this->render('service/index.html.twig',[
            'banner'=>[
                'image'=>'https://imgur.com/nXi0gDs.jpg',
                'body'=>'
                <h2 class="arrow a-header">Диагностика</h2>
                <h2 class="arrow a-header">Сервисное обслуживание</h2>
                <h2 class="arrow a-header">Сочи</h2>
                <h2 class="arrow a-header"><a href="/ticket/service">Записаться на прием<a/></h2>
                '
            ]
        ]);
    }
}
