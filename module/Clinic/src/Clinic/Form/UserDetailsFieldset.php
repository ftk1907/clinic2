<?php
namespace Clinic\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class UserDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('User Details');

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