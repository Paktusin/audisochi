<?php

namespace App\Form;

use App\Entity\TicketService;
use App\Service\CommonService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketServiceType extends AbstractType
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'phone'
                ]
            ])
            ->add('brand', ChoiceType::class, [
                'choices' => $this->container->get(CommonService::class)->getBrands(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                }
            ])
            ->add('model')
            ->add('year')
            ->add('miles')
            ->add('reg_number')
            ->add('comment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TicketService::class,
        ]);
    }


}
