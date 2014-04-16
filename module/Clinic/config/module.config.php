<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'adminIndex'        => 'Clinic\Controller\AdminIndexController',
            'adminAppointment'  => 'Clinic\Controller\AdminAppointmentController',
            'adminPatient'      => 'Clinic\Controller\AdminPatientController',
            'adminPractitioner' => 'Clinic\Controller\AdminPractitionerController',
            'adminDoctor'       => 'Clinic\Controller\AdminDoctorController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'adminIndex' => array(
                    'type'    => 'segment',
                    'options' => array(
                    'route'    => '/admin/index[/:action][/:id]', //[/:controller][/:action][/:id]
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adminIndex',
                        'action'     => 'index',
                    ),
                ),
            ),
            'adminAppointment' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/appointment[[/]:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adminAppointment',
                        'action'     => 'index',
                    ),
                ),
            ),
            'adminPatient' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/patient[[/]:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adminPatient',
                        'action'     => 'index',
                    ),
                ),
            ),
            'adminPractitioner' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/practitioner[[/]:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adminPractitioner',
                        'action'     => 'index',
                    ),
                ),
            ),
            'adminDoctor' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/doctor[[/]:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adminDoctor',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Clinic/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Clinic\Entity' =>  'application_entities'
                ),
            ),
        ),
    ),
);

