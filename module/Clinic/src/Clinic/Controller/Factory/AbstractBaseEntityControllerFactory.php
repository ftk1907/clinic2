<?php
namespace Clinic\Controller\Factory;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractPluginManager;

class AbstractBaseEntityControllerFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (! $serviceLocator instanceof AbstractPluginManager) {
            throw new \BadMethodCallException('This abstract factory is meant to be used only with a plugin manager');
        }

        $parentLocator = $serviceLocator->getServiceLocator();
        $config        = $parentLocator->get('config');

        return isset($config['entity_controllers'][$requestedName]);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (! $this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            throw new \BadMethodCallException('This abstract factory can\'t create service "' . $requestedName . '"');
        }
        // Entity manager dependency
        $parentLocator = $serviceLocator->getServiceLocator();
        $config        = $parentLocator->get('config');
        $entityManager = $parentLocator->get('Doctrine\ORM\EntityManager');
        // Repository dependency
        $entityPath    = $config['entity_controllers'][$requestedName];
        $repository    = $entityManager->getRepository($entityPath);

        return new \Clinic\Controller\BaseEntityController($entityManager, $repository, $requestedName);
    }
}
