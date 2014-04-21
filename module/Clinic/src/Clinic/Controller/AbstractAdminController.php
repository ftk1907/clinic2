<?php

namespace Clinic\Controller;
use Zend\Mvc\Controller\AbstractActionController;

abstract class AbstractAdminController extends AbstractActionController {

    private $repository;

    /**
     * Service locator function for repository.
     * @param $entityName
     * @return Repository
     **/
    protected function getRepository($entityName)
    {
        $entityPath = "Clinic\Entity\\{$entityName}";
        $em = $this->getEntityManager();
        $this->repository = $em->getRepository($entityPath);
        return $this->repository;
    }

    protected function getEntityManager()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    public function getMessagePage($page, $message, $url)
    {
        $view = new \Zend\View\Model\ViewModel(['url' => $url, 'message' => $message]);
        $view->setTemplate("clinic/generic/{$page}");
        return $view;
    }

    /**
     * @access public
     * @param a$id
     */
    public abstract function addAction();

    /**
     * @access public
     * @param a$id
     */
    public abstract function editAction();

    /**
     * @access public
     * @param a$id
     */
    public abstract function profileAction();

    /**
     * @access public
     * @param a$id
     */
    public abstract function deleteAction();

    /**
     * returns appointments
     *
     * @return void
     * @author
     **/
    public abstract function appointmentsAction();

}