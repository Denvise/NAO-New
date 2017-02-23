<?php

namespace NAO\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Nom utilisateur'))
            ->add('lastname', TextType::class, array('label' => 'Nom'))
            ->add('firstname', TextType::class, array('label' => 'Prénom'))
            ->add('accountType', ChoiceType::class, array(
                'label' => 'Groupe',
                'choices' => array(
                    'Particulier' => 'Particulier',
                    'Naturaliste' => 'Naturaliste'
                )
            ))
            ->add('password', PasswordType::class, array('label' => 'Mot de passe'))
            ->add('question', TextType::class, array('label' => 'Question secrète'))
            ->add('validate', SubmitType::class, array(
                'label' => 'Créer un compte',
                'attr' => array('class' => 'btn-success')
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'NAO\CoreBundle\Entity\User'));
    }

    public function getBlockPrefix()
    {
        return 'nao_corebundle_user';
    }
}
