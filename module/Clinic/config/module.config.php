<?php
return [

    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/admin[/:controller[/:action]][/:id]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[a-z0-9]*',
                    ],
                    'defaults' => [
                        'controller' => 'appointment',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'abstract_factories' => [
            'Clinic\Controller\Factory\AbstractBaseEntityControllerFactory',
        ],
        'factories' => [
            'appointment'  => 'Clinic\Controller\Factory\AppointmentControllerFactory',
            'patient'      => 'Clinic\Controller\Factory\PatientControllerFactory',
        ],
    ],

    'entity_controllers' => [
        'appointment'  => 'Clinic\Entity\Appointment',
        'patient'      => 'Clinic\Entity\Patient',
        'practitioner' => 'Clinic\Entity\Practitioner',
        'doctor'       => 'Clinic\Entity\Doctor',
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Clinic/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'Clinic\Entity' =>  'application_entities'
                ],
            ],
        ],
    ],
];