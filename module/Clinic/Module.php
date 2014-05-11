<?php
namespace Clinic;
use Clinic\Entity\Appointment;
use Clinic\Entity\Doctor;
use Clinic\Entity\Patient;
use Clinic\Entity\Practitioner;

use Clinic\Form\DoctorRegisterForm;
use Clinic\Form\PractitionerRegisterForm;
use Clinic\Form\PatientRegisterForm;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(

                'PractitionerRegisterForm' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $practitioner = new Practitioner;
                    $form = new PractitionerRegisterForm($entityManager, $practitioner);
                    return $form;
                },

                'DoctorRegisterForm' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $doctor = new Doctor;
                    $form = new DoctorRegisterForm($entityManager, $doctor);
                    return $form;
                },

                'PatientRegisterForm' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $patient = new Patient;
                    $form = new PatientRegisterForm($entityManager, $patient);
                    return $form;
                },

            ),
        );
    }
}