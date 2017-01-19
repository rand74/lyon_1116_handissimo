<?php

namespace HandissimoBundle\Admin;


use Doctrine\DBAL\Types\TextType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StaffTypesAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('secteur', TextType::class,
                array(
                    'label' => 'Secteur',
                    'required' => false
                ))
            ->add('typesstaff',EntityType::class,array (
                'class' => 'HandissimoBundle:StaffTypes',
                'choice_label' => 'secteur',
                'label' => false,
                'expanded' => true,
                'by_reference' => true,
                'disabled' => true
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('secteur', null,
                array(
                    'label' => 'Secteur'
                ));
    }
}