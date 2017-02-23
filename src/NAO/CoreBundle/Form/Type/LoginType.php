<?php

namespace NAO\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('lastname')
            ->remove('firstname')
            ->remove('accountType')
            ->remove('question');
    }

    public function getParent()
    {
        return UserType::class;
    }
}
