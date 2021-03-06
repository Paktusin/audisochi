<?php
/**
 * Created by PhpStorm.
 * User: paktus-lnx
 * Date: 01.05.18
 * Time: 17:18
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImgurType extends AbstractType
{
    public function getParent()
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'attr'=>[
                'class'=>'hidden'
            ]
        ]);
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['multipart'] = true;
        parent::finishView($view, $form, $options); // TODO: Change the autogenerated stub
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CallbackTransformer(
            function ($imgAsArray) {
                if ($imgAsArray)
                    return json_encode($imgAsArray);
                else return null;
            },
            function ($imgAsString) {
                if (mb_strlen($imgAsString) > 0)
                    return json_decode($imgAsString, true);
                else return null;
            }
        ));
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
    }


}