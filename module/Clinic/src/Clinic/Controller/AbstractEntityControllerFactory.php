<?php

namespace Clinic\Controller;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
*
*/
class AbstractEntityControllerFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (! $serviceLocator instanceof AbstractPluginManager) {
            throw new \BadMethodCallException('This abstract factory is meant to be used only with a plugin manager');
        }
        $parentLocator = $serviceLocator->getServiceLocator();
        $config = $parentLocator->get('config');
        return isset($config['entity_controllers'][$requestedName]);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (! $this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            throw new \BadMethodCallException('This abstract factory can\'t create service "' . $requestedName . '"');
        }

        $parentLocator = $serviceLocator->getServiceLocator();
        $config = $parentLocator->get('config');

        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $entityName = $config['entity_controllers'][$requestedName];

        return new AdminBaseController($entityManager, $entityName, $requestedName);
    }
}