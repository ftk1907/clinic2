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
    protected $_template;

    function __construct($entityManager = null, $entityName = null, $entity = null)
    {
        if (!is_null($entityManager)) {
            $this->_entityManager = $entityManager;
        }
        $this->_repository = $this->_entityManager->getRepository($entity);
        $this->_template = "clinic/generic/{$entityName}";
    }

    public function indexAction()
    {
        $appointments = $this->entityManager('Appointment');
        $appointments = $appointments->findAll();
        $appointmentsView = new ViewModel(['appointments' => $appointments]);
        $appointmentsView->setTemplate('clinic/admin-index/appointments');

        $doctors     = $this->entityManager('Doctor');
        $doctors     = $doctors->findAll();
        $doctorsView = new ViewModel(['doctors' => $doctors]);
        $doctorsView->setTemplate('clinic/admin-index/doctors');

        $practitioners     = $this->entityManager('Practitioner');
        $practitioners     = $practitioners->findAll();
        $practitionersView = new ViewModel(['practitioners' => $practitioners]);
        $practitionersView->setTemplate('clinic/admin-index/practitioners');

        $patients     = $this->entityManager('Patient');
        $patients     = $patients->findAll();
        $patientsView = new ViewModel(['patients' => $patients]);
        $patientsView->setTemplate('clinic/admin-index/patients');

        $view = new ViewModel();
        $view->addChild($appointmentsView, 'appointmentsView')
             ->addChild($doctorsView, 'doctorsView')
             ->addChild($practitionersView, 'practitionersView')
             ->addChild($patientsView, 'patientsView');

        return $view;
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function getAction()
    {
        $id = $this->params('id');
        $entity = null;

        if($id) {
            $entity = $this->_repository->find(['id'=>$id]);
        } else {
            $entity = $this->_repository->findAll();
        }

        $view =  new ViewModel($entityName . 's' => $entity);
        $view->setTemplate($this->_template);
        return $view;
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $url = $this->getRequest()->getHeaders('Referer');
        $url = '/home';
        if($id) {
            try {
                $entity = $this->_repository->find(['id'=>$id]);
                $em->remove($entity);
                $em->flush();
                // success
                return $this->getMessagePage('success', "{$entityName} deleted!", $url);
            }
            catch (Exception $e) {}
        }
        return $this->getMessagePage('error', 'Unknown Error: Appointment was not to deleted!', $url);
    }

    /**
     * returns appointments
     *
     * @return void
     * @author
     **/
    public function appointmentsAction()
    {
    }
}