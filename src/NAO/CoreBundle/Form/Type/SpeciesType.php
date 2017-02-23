<?php

namespace NAO\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SpeciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('date')
            ->remove('latitude')
            ->remove('longitude')
            ->remove('image');
    }

    public function getParent()
    {
        return ObservationType::class;
    }
}
