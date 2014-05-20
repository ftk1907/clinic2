<?php
namespace Clinic\Controller\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Clinic\Controller\PatientController;

class PatientControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        $config        = $parentLocator->get('config');
        $entityManager = $parentLocator->get('Doctrine\ORM\EntityManager');

        $requestedName = 'patient'; // important! imitates abstract factory
        $entityPath    = $config['entity_controllers'][$requestedName];
        $repository    = $entityManager->getRepository($entityPath);

        return new PatientController($entityManager, $repository, $requestedName);
    }
}