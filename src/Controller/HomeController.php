<?php

namespace App\Controller;

use App\Service\ImgUrService;
use App\Service\ParseService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->redirectToRoute('part_index');
        //return $this->render('home/index.html.twig', []);
    }

//    /**
//     * @Route("/test")
//     */
//    public function test()
//    {
//        $this->get(ParseService::class)->parseAudi();
//        return $this->json([]);
//    }
}
