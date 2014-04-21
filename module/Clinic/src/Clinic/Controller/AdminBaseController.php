<?php

namespace Clinic\Controller;
use Zend\View\Model\ViewModel;
use Clinic\Controller\AbstractAdminController;

/**
*
*/
class AdminBaseController extends AbstractAdminController
{
    protected $_entityManager;
    protected $_repository;
    protected $_entityName;
    protected $_template;

    function __construct($entityManager = null, $entityPath = null, $entityName = null)
    {
        if (!is_null($entityManager)) {
            $this->_entityManager = $entityManager;
        }
        $this->_entityName = $entityName;
        $this->_repository = $this->_entityManager->getRepository($entityPath);
        $this->_template = "clinic/generic/{$entityName}";
    }

    public function getMessagePage($page, $message, $url)
    {
        $view = new ViewModel(['url' => $url, 'message' => $message]);
        $view->setTemplate("clinic/generic/{$page}");
        return $view;
    }

    public function indexAction()
    {
        $entity = $this->_repository->findAll();
        $view =  new ViewModel([$this->_entityName . 's' => $entity]);
        $view->setTemplate($this->_template . '/all');
        return $view;
    }

    public function addAction()
    {
        //TODO: Form
    }

    public function editAction()
    {
        //TODO: Form
    }

    public function profileAction()
    {
        $id = $this->params('id');
        $entity = $this->_repository->find(['id' => $id]);

        if(!is_null($entity)) {
            $view   =  new ViewModel([$this->_entityName => $entity]);
            $view->setTemplate($this->_template . '/profile');
            return $view;
        } else {
           $this->redirect()->toRoute('admin', [
                'controller' => $this->_entityName,
                'action'     => 'index',
            ]);
        }
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $entity = $this->_repository->find(['id' => $id]);
        $referer = $this->getRequest()->getHeader('referer')->getUri();

        if(!is_null($entity)) {
            try {
                $this->_entityManager->remove($entity);
                $this->_entityManager->flush();
                return $this->getMessagePage(
                    'success', "{$this->_entityName} with id {$id} was deleted!", $referer
                );
            } catch (Exception $e) {
                break; // continue
            }
        }
        return $this->getMessagePage('error', '{$this->_entityName} was not to deleted!', $referer);
    }

    /**
     * returns appointments
     * @deprecated return profile...
     * @return void
     * @author
     **/
    public function appointmentsAction()
    {
        $id = $this->params('id');
        $entity = $this->_repository->find(['id' => $id]);

        // $entity exist, isn't an array, or requested entity isn't appointment
        if(!is_null($entity) && !is_array($entity) && !($this->_entityName == 'appointment')) {
            $appointments = $entity->getAppointments();
            $view = new ViewModel(['appointments' => $appointments]);
            $view->setTemplate('clinic/generic/appointment/all');
            return $view;
        } else { // otherwise redirect to all appointments
            $this->redirect()->toRoute('admin', [
                'controller' => 'appointment',
                'action'     => 'index',
            ]);
        }
    }
}