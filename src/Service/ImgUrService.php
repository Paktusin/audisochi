<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:14
 */

namespace App\Service;

use App\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImgUrService extends Service
{
    private $client;

    /**
     * ImgUrService constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->client = new \Imgur\Client();
        $this->client->setOption('client_id', $this->container->getParameter('imgur_id'));
        $this->client->setOption('client_secret', $this->container->getParameter('imgur_secret'));
    }


    public function uploadImage($file)
    {
        if (!file_exists($file)) throw new NotFoundHttpException('Файл не найден');
        $uploaded = $this->client->api('image')->upload([
            'image' => base64_encode(file_get_contents($file)),
            'type' => 'base64'
        ]);
        unlink($file);
        return [
            'link'=>$uploaded['link'],
            'deletehash'=>$uploaded['deletehash']
        ];
    }

    public function deleteImage($url)
    {
        $uploaded = $this->client->api('image')->deleteImage($url);
        return $uploaded['link'];
    }
}