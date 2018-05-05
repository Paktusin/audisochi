<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 16:27
 */

namespace App\Admin;


use App\Form\Type\ImgurType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CarAdmin extends Admin
{

    protected $imgUr_fields = ['image'];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('brand')
            ->add('model')
            ->add('image', ImgurType::class)
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('model')
            ->add('brand')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('model')
            ->add('brand')
            ->add('image',null,[
                'template'=>'image_field.html.twig'
            ])
        ;
        parent::configureListFields($listMapper);
    }
}