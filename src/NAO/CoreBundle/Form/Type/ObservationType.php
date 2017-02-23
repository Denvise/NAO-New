<?php

namespace NAO\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ObservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('species', EntityType::class, array(
                'class' => 'NAOCoreBundle:Species',
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('s')->orderBy('s.name', 'ASC');
                },
                'label' => 'Espèce',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('date', DateType::class, array(
                'label' => 'Date',
                'widget' => 'single_text'
            ))
            ->add('latitude', TextType::class, array('label' => 'Latitude'))
            ->add('longitude', TextType::class, array('label' => 'Longitude'))
            ->add('image', FileType::class, array('label' => 'Photo'))
            ->add('validate', SubmitType::class, array(
                'label' => 'Valider',
                'attr' => array('class' => 'btn-success')
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'NAO\CoreBundle\Entity\Observation'));
    }

    public function getBlockPrefix()
    {
        return 'nao_corebundle_observation';
    }
}
