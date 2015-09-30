<?php

namespace AdFinemSimpleFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', []);
        $builder->add('surname', 'text', []);
        $builder->add('email', 'text', []);
        
        $builder->add('attachments', 'collection', [
            'type' => new AttachmentType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ]);
        
        $builder->add('add', 'submit', ['label' => 'Add data']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdFinemSimpleFormBundle\Entity\Person',
        ));
    }

    public function getName()
    {
        return 'person';
    }
}
