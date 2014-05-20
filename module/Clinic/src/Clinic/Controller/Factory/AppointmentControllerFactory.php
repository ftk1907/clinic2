<?php
namespace Clinic\Controller\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Clinic\Controller\AppointmentController;

class AppointmentControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        $config        = $parentLocator->get('config');
        $entityManager = $parentLocator->get('Doctrine\ORM\EntityManager');

        $requestedName = 'appointment';
        $entityPath    = $config['entity_controllers'][$requestedName];
        $repository    = $entityManager->getRepository($entityPath);

        return new AppointmentController($entityManager, $repository, $requestedName);
    }
}