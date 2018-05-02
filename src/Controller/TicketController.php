<?php

namespace App\Controller;

use App\Entity\TicketService;
use App\Form\TicketServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("ticket")
 */
class TicketController extends Controller
{
    /**
     * @Route("/part ", name="part_ticket")
     */
    public function part(Request $request)
    {
        return $this->render('ticket/index.html.twig', [
            'title' => 'Сделать заказ'
        ]);
    }

    /**
     * @Route("/service ", name="service_ticket")
     */
    public function service(Request $request)
    {
        $ticket = new TicketService();
        $formBuilder = $this->createForm(TicketServiceType::class, $ticket);
        return $this->render('ticket/service.html.twig', [
            'title' => 'Запись на сервис',
            'form' => $formBuilder->createView()
        ]);
    }

    private function done()
    {

    }
}
