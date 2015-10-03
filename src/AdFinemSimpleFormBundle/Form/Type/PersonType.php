<?php

namespace AdFinemSimpleFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', []);
        $builder->add('surname', 'text', []);
        $builder->add('email', 'text', []);
        
        /* 
         * To build different form for action "add" or "edit"
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $entity = $event->getData();
            $form = $event->getForm();
            
            // check if the entity object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "entity"
            $isActionAdd = !$entity || null === $entity->getId();
            if ($isActionAdd) {
                
                $form->add('attachments', 'collection', [
                    'type' => new AttachmentType(),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]);
                
                $form->add('add', 'submit', ['label' => 'Add data']);
            } else {
                $form->add('save', 'submit', ['label' => 'Save data']);
            }
        });
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
