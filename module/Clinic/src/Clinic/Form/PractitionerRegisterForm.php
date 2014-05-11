<?php
namespace Clinic\Form;

use Clinic\Entity\Practitioner;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as Hydrator;

class PractitionerRegisterForm extends
Form implements InputFilterProviderInterface
{

    private $entityManager;

    public function __construct($entityManager, $entity)
    {
        parent::__construct('Practitioner Registration');

        $this->entityManager = $entityManager;

        $this
            ->setAttribute('method', 'post')
            ->setHydrator(new Hydrator($entityManager))
            ->setObject($entity)
        ;

        $this->add(array(
            'name' => 'supervisor',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label'           => 'Supervisor',
                'object_manager'  => $this->entityManager,
                'target_class'    => 'Clinic\Entity\Doctor',
                'label_generator' => function($targetEntity) {
                    return    $targetEntity->getId()
                    . ' - ' . $targetEntity->getSurname()
                    . ' '   . $targetEntity->getName();
                },
                'empty_option'  => 'Select Supervisor'
            ),
            'attributes' => array(
                'required' => 'true',
                'class'    => 'form-control',
            ),
        ));

        // $this->add(array(
        //     'name' => 'user-details',
        //     'type' => 'Clinic\Form\UserDetailsFieldset',
        //     'options' => array(
        //         'use_as_base_fieldset' => true
        //     ),
        // ));

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name',
            ),
            'attributes' => array(
                'autofocus' => 'true',
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'surname',
            'type' => 'text',
            'options' => array(
                'label' => 'Surname',
            ),
            'attributes' => array(
                'placeholder' => '',
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'placeholder' => 'your@email.com',
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'email-confirm',
            'type' => 'email',
            'options' => array(
                'label' => 'Confirm Email',
            ),
            'attributes' => array(
                'placeholder' => 'your@email.com',
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));


        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'password-confirm',
            'type' => 'password',
            'options' => array(
                'label' => 'Confirm Password',
            ),
            'attributes' => array(
                'required' => 'true',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value'    => 'Add',
                'id'       => 'submitbutton',
                'required' => 'true',
                'class'    => 'btn btn-default',
            ),
        ));
    }

    /**
     * @deprecated
     */
    private function getSupervisorOptions()
    {
        $doctors = $this->entityManager->getRepository('Clinic\Entity\Doctor')->findAll();
        $supervisorOptions = array();
        foreach($doctors as $doctor) {
            echo $doctor->getName();
            $superVisorOptions[$doctor->getId()] = "{$doctor->getSurname()} {$doctor->getName()}";
        }
        return $supervisorOptions;
    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            ),
            'surname' => array(
                'required' => true,
            ),
            'email' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'EmailAddress'
                    ),
                ),
            ),
            'email-confirm' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'email',
                            'messages' => array(
                                'notSame' => 'Emails do not match'
                            ),
                        ),
                    ),
                ),
            ),
            'password' => array(
                'required' => true,
            ),
            'password-confirm' => array(
                'validators' => array(
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'password',
                            'messages' => array(
                                'notSame' => 'Passwords do not match'
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}