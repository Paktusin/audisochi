<?php

namespace App\Controller;

use App\Entity\TicketService;
use App\Form\TicketPartType;
use App\Form\TicketServiceType;
use App\Service\CommonService;
use Symfony\Component\Form\FormError;
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
        $ticket = new TicketService();
        $formBuilder = $this->createForm(TicketPartType::class, $ticket);
        $formBuilder->handleRequest($request);
        if ($formBuilder->isSubmitted() && $formBuilder->isValid()) {
            if ($this->checkRobot($request)) {
                $parts = $request->request->get('parts');
                if ($parts) {
                    return $this->done($ticket->getName(), $ticket->getPhone());
                } else {
                    $formBuilder->addError(new FormError('Вы ничего не вырбрали для заказа'));
                }
            }
        }
        return $this->render('ticket/part.html.twig', [
            'title' => 'Сделать заказ',
            'form' => $formBuilder->createView()
        ]);
    }

    /**
     * @Route("/service ", name="service_ticket")
     */
    public function service(Request $request)
    {
        $ticket = new TicketService();
        $formBuilder = $this->createForm(TicketServiceType::class, $ticket);
        $formBuilder->handleRequest($request);
        if ($formBuilder->isSubmitted() && $formBuilder->isValid()) {
            if ($this->checkRobot($request)) {
                return $this->done($ticket->getName(), $ticket->getPhone());
            }
        }
        return $this->render('ticket/service.html.twig', [
            'title' => 'Запись на сервис',
            'form' => $formBuilder->createView()
        ]);
    }

    private function done($name, $phone)
    {
        return $this->render('/ticket/done.html.twig', [
            'name' => $name,
            'phone' => $phone
        ]);
    }

    private function checkRobot(Request $request)
    {
        $check = $this->get(CommonService::class)->checkReCaptcha($request);
        if (!$check) {
            $this->addFlash('danger', 'Вы не прошли проверку на робота');
        }
        return $check;
    }
}
