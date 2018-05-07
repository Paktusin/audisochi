<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Service;
use Symfony\Component\HttpFoundation\Request;

class CommonService extends Service
{
    public function getBrands()
    {
        return $this->container->getParameter('brands');
    }

    /**
     * @return bool
     */
    public function checkReCaptcha(Request $request)
    {
        $gReCaptchaResponse = $request->request->get('g-recaptcha-response');
        $enabled = $this->container->getParameter('recaptcha_enable') === 'true';
        if ($enabled) {
            $secret = $this->container->getParameter('recaptcha_secret');
            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response=" . $gReCaptchaResponse;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($response);
        }
        return !$enabled || $obj->success == true;
    }
}