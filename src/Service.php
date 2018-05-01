<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 15:15
 */

namespace App;


use Symfony\Component\DependencyInjection\ContainerInterface;

class Service
{
    protected $class;
    protected $repo;
    protected $em;
    protected $container;

    /**
     * Service constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
        if ($this->class)
            $this->repo = $this->container->get('doctrine')->getRepository($this->class);
    }

    public function repo()
    {
        return $this->repo;
    }
}