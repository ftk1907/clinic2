<?php

namespace Clinic\Controller;
use Zend\View\Model\ViewModel;
use Clinic\Controller\AbstractAdminController;

/**
*
*/
class AdminIndexController extends AbstractAdminController
{
    function __construct()
    {

    }

    public function indexAction()
    {
        $appointments = $this->getRepository('Appointment');
        $appointments = $appointments->findAll();
        $appointmentsView = new ViewModel(['appointments' => $appointments]);
        $appointmentsView->setTemplate('clinic/admin-index/appointments');

        $doctors     = $this->getRepository('Doctor');
        $doctors     = $doctors->findAll();
        $doctorsView = new ViewModel(['doctors' => $doctors]);
        $doctorsView->setTemplate('clinic/admin-index/doctors');

        $practitioners     = $this->getRepository('Practitioner');
        $practitioners     = $practitioners->findAll();
        $practitionersView = new ViewModel(['practitioners' => $practitioners]);
        $practitionersView->setTemplate('clinic/admin-index/practitioners');

        $patients     = $this->getRepository('Patient');
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
    }

    public function deleteAction()
    {
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