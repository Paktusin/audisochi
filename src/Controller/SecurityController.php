<?php
/**
 * Created by PhpStorm.
 * User: davlichin
 * Date: 07.05.18
 * Time: 11:37
 */

namespace App\Controller;

use App\Service\CommonService;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends BaseController
{
    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {
        if ($request->getMethod() === 'GET') return parent::loginAction($request);
        if ($this->get(CommonService::class)->checkReCaptcha($request)) {
            return $this->redirectToRoute('fos_user_security_check', ['request' => $request], 307);
        } else {
            $this->addFlash('danger', 'Вы не прошли проверку на робота');
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}