<?php

namespace HandissimoBundle\Admin;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class OrganizationsAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('societies', EntityType::class, array(
                'class' => 'HandissimoBundle:Society',
                'choice_label' => 'society_name',
                'label' => 'Organisme gestionnaire'
            ))
            ->add('name', TextType::class, array(
                'label' => 'Nom de l\'organisation',
                'required' => true
            ))
            ->add('address', TextType::class, array(
                'label' => 'Adresse postale',
                'required' => true
            ))
            ->add('postal', TextType::class, array(
                'label' => 'Code postal',
                'required' => true,
            ))
            ->add('city', TextType::class, array(
                'label' => 'Ville',
                'required' => true
            ))
            ->add('phone_number', TextType::class, array(
                'label' => 'Téléphone',
                'required' => true
            ))
            ->add('mail', TextType::class, array(
                'label' => 'E-mail de contact',
                'required' => true
            ))
            ->add('website', TextType::class, array(
                'label' => 'Site internet',
                'required' => false
            ))
            ->add('blog', TextType::class, array(
                'label' => 'Blog',
                'required' => false
            ))
            ->add('facebook', TextType::class, array(
                'label' => 'Facebook',
                'required' => false
            ))
            ->add('twitter', TextType::class, array(
                'label' => 'Twitter',
                'required' => false
            ))
            ->add('agemini', IntegerType::class, array(
                'label' => 'Âge minimum',
                'required' => false
            ))
            ->add('agemaxi', IntegerType::class, array(
                'label' => 'Âge maximum',
                'required' => false
            ))
            ->add('freeplace', IntegerType::class, array(
                'label' => 'Nombre de places disponibles',
                'required' => false
            ))
            ->add('organization_description', 'ckeditor', array(
                'label' => 'Description de la structure',
                'required' => false
            ))
            ->add('serve_description', 'ckeditor', array(
                'label' => 'Description des services',
                'required' => false
            ))
            ->add('openhours', TextType::class, array(
                'label' => 'Heures d\'ouverture',
                'required' => false
            ))
            ->add('opendays', 'ckeditor', array(
                'label' => 'Jours d\'ouverture',
                'required' => false
            ))
            ->add('team_members_number', TextType::class, array(
                'label' => 'Nombre de membres du personnel',
                'required' => false
            ))
            ->add('team_description', 'ckeditor', array(
                'label' => 'Description de la ou des équipe(s)',
                'required' => false
            ))
            ->add('working_description', 'ckeditor', array(
                'label' => 'Description du travail effectué',
                'required' => false
            ))
            ->add('school', CheckboxType::class, array(
                'label' => 'Ètes-vous un établissement scolaire ?',
                'required' => false
            ))
            ->add('school_description', 'ckeditor', array(
                'label' => 'Description de l\'établissement',
                'required' => false,
            ))
            ->add('disabilitytypes',EntityType::class,array (
                'class' => 'HandissimoBundle:DisabilityTypes',
                'choice_label' => 'disabilityName',
                'label' => 'Type de handicap',
                'multiple' => true
            ))
            ->add('Stafforganizations', EntityType::class, array(
                'class' => 'HandissimoBundle:Staff',
                'choice_label' => 'jobs',
                'label' => 'Métier',
                'multiple' => true
            ))
            ->add('needs', EntityType::class, array(
                'class' => 'HandissimoBundle:Needs',
                'choice_label' => 'needName',
                'label' => 'Type de service',
                'multiple' => true
            ))
            ->add('structuretype', EntityType::class, array(
                'class' => 'HandissimoBundle:StructuresTypes',
                'choice_label' => 'structurestype',
                'label' => 'Type de structure',
                'multiple' => false,
                'by_reference' => true,
                'expanded' => false
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                    ->add('name')
                    ->add('postal');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper ->addIdentifier( 'name' , null, array ( 'label' => 'Nom de l\'organisation') )
                    ->add( 'address' , null, array ( 'label' => 'Adresse') )
                    ->add( 'postal' , null, array ( 'label' => 'Code postale') )
                    ->add( 'city' , null, array ( 'label' => 'Ville') )
                    ->add( 'phone_number' , null, array ( 'label' => 'Téléphone') )
                    ->add( 'mail' , null, array ( 'label' => 'Adresse e-mail') )
        ;
    }
}
