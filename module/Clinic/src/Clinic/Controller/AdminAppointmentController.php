<?php
namespace Clinic\Controller;
use Clinic\Controller\AbstractAdminController;
use Zend\View\Model\ViewModel;

/**
*
*/
class AdminAppointmentController extends AbstractAdminController
{
    public function indexAction()
    {

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
        $id = $this->params('id');
        $page = 'error';
        $url = $this->getRequest()->getHeaders('Referer');
        $url = '/home';
        if($id) {
            try {
                $em = $this->getEntityManager();
                $appointment = $this->getRepository('Appointment');
                $appointment->findBy(['id'=>$id]);
                $em->remove($appointment);
                $em->flush();
                // success
                return $this->getMessagePage('success', 'Appointment deleted!', $url);
            }
            catch (Exception $e) {}
        }
        return $this->getMessagePage('error', 'Unknown Error: Appointment was not to deleted!', $url);
    }

    public function appointmentsAction()
    {

    }
}