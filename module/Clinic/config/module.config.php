<?php
return array(

    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/admin[/:controller][/:action][/:id]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[a-z0-9]*',
                    ],
                    'defaults' => [
                        // 'controller' => 'appointment',
                        // 'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'abstract_factories' => [
            'Clinic\Controller\AbstractEntityControllerFactory',
        ],
    ],

    'entity_controllers' => [
        'appointment'  => 'Clinic\Entity\Appointment',
        'patient'      => 'Clinic\Entity\Patient',
        'practitioner' => 'Clinic\Entity\Practitioner',
        'doctor'       => 'Clinic\Entity\Doctor',
    ],

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

