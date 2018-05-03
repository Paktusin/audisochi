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

class PartAdmin extends Admin
{
    protected $imgUr_fields = ['image'];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('type')
            ->add('description')
            ->add('cnt')
            ->add('price')
            ->add('image', ImgurType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('type')
            ->add('cnt')
            ->add('price')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('type')
            ->add('cnt')
            ->add('price')
            ->add('image',null,[
                'template'=>'image_field.html.twig'
            ])
        ;
        parent::configureListFields($listMapper);
    }
}