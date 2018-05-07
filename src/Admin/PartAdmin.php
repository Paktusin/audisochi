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
            ->add('isActive')
            ->add('description', null, [
                'attr' => [
                    'class' => 'cke-editor'
                ]
            ])
            ->add('price')
            ->add('image', ImgurType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('isActive')
            ->add('name')
            ->add('type')
            ->add('price');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('isActive')
            ->add('name')
            ->add('type')
            ->add('price')
            ->add('image', null, [
                'template' => 'image_field.html.twig'
            ]);
        parent::configureListFields($listMapper);
    }
}