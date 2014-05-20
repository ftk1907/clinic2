<?php
namespace Clinic\Form;

use Clinic\Entity\Doctors;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as Hydrator;

class FeedbackForm extends Form
implements InputFilterProviderInterface {

    private $entityManager;

    public function __construct($entityManager)
    {
        parent::__construct('Doctor Registration');

        $this->entityManager = $entityManager;

        $this
            ->setAttribute('method', 'post')
            ->setHydrator(new Hydrator($entityManager))
        ;

        $this->add(array(
            'name' => 'complaints',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Feedback',
            ),
            'attributes' => array(
                'autofocus' => 'true',
                'class'     => 'form-control',
                'rows'      => 10,
                'cols'      => 70,
            ),
        ));

        $this->add(array(
            'name' => 'patientFeedback',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Feedback',
            ),
            'attributes' => array(
                'autofocus' => 'true',
                'class'     => 'form-control',
                'rows'      => 10,
                'cols'      => 70,
            ),
        ));

        $this->add(array(
            'name' => 'doctorFeedback',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Feedback',
            ),
            'attributes' => array(
                'autofocus' => 'true',
                'class'     => 'form-control',
                'rows'      => 10,
                'cols'      => 70,
            ),
        ));

        $this->add(array(
            'name' => 'practitionerFeedback',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Feedback',
            ),
            'attributes' => array(
                'autofocus' => 'true',
                'class'     => 'form-control',
                'rows'      => 10,
                'cols'      => 70,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id'    => 'submitbutton',
                'class' => 'btn btn-default',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }
}