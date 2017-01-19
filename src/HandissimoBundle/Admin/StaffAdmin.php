<?php

namespace HandissimoBundle\Admin;


use Doctrine\DBAL\Types\TextType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use HandissimoBundle\HandissimoBundle;

class StaffAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('jobs', TextType::class,
                array(
                    'label' => 'Métiers',
                    'required' => false
                ))
            ->add('staff', EntityType::class, array(
                'class' => 'HandissimoBundle:StaffTypes',
                'choice_label' => 'secteur',
                'label' => 'Types de personnel',
                'required' => false

            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('jobs', null,
                array(
                    'label' => 'Métiers'
                ));
    }
}