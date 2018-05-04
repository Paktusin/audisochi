<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 21:08
 */

namespace App\Twig;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\TwigFilter;
use Twig_Extension;

class Extension extends Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'main.extension';
    }

    public function getFilters()
    {
        return [
            new TwigFilter('json_decode', [$this, 'jsonDecode']),
            new TwigFilter('image', [$this, 'image']),
        ];
    }

    public function jsonDecode($str)
    {
        return json_decode($str, true);
    }

    public function image($arr)
    {
        if ($arr && isset($arr['link'])) {
            return $arr['link'];
        }
        return null;
    }
}