<?php
namespace Clinic\Controller;
use Zend\View\Model\ViewModel;

class AppointmentController extends BaseEntityController
{
    public function __construct($entityManager, $repository, $entityName)
    {
        parent::__construct($entityManager, $repository, $entityName);
    }

    public function indexAction()
    {
        $entity = $this->_repository;
        $view   = new ViewModel([$this->_entityName . 's' => $entity]);
        $view->setTemplate($this->_template . '/all');
        return $view;
    }

    /**
     * Un/Set an appointment as visited
     * @return ViewModel
     **/
    public function visitAction()
    {
        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action' => 'index',
        ]);

        $id     = $this->params('id');
        $entity = $this->_repository->find($id);

        if($entity) {
            $entity->setMissed(!$entity->getMissed());
            $this->_entityManager->persist($entity);
            $this->_entityManager->flush();
            return $this->getMessagePage('success', 'Action applied', $url);
        }

        return $this->getMessagePage('error', 'Invalid URL', $url);
    }

    /**
     * Un/Confirm an appointment
     * @return void
     **/
    public function confirmAction()
    {
        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action' => 'index',
        ]);

        $id     = $this->params('id');
        $entity = $this->_repository->find($id);

        if($entity) {
            $entity->setConfirmed(!$entity->getConfirmed());
            $this->_entityManager->persist($entity);
            $this->_entityManager->flush();
            ;
            return $this->getMessagePage('success', 'Action applied', $url);
        }

        return $this->getMessagePage('error', 'Invalid URL', $url);
    }

    /**
     * Helper method to processes feedback
     * @return ViewModel
     **/
    protected function feedbackForm($page)
    {
        $request = $this->getRequest();
        $id = $this->params('id');

        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action'     => 'patientFeedback',
            'id'         => $id
        ]);

        $entity = $this->_repository->find($id);

        if(!$entity) {
            $indexURL = $this->url()->fromRoute('admin', [
                'controller' => $this->_entityName,
                'action'     => 'index'
            ]);
            return $this->getMessagePage('error', 'Id not found', $indexURL);
        }

        $form = $this->getServiceLocator()->get('feedbackForm');
        $form->setAttribute('action', $url);
        $form->bind($entity);

        if ( $request->isPost() ) {
            $form->setData($request->getPost());
            if( $form->isValid() ) {
                try {
                    $this->_entityManager->persist($entity);
                    $this->_entityManager->flush();
                    $profile = $this->url()->fromRoute('admin', [
                        'controller' => $this->_entityName,
                        'action'     =>'profile',
                        'id'         => $entity->getId()
                    ]);
                    return $this->getMessagePage('success', "{$this->_entityName} is successfully updated", $profile);
                }
                catch (\Exception $e) {
                    return $this->getMessagePage('error', 'An error occurred, form was not processed', $url);
                }
            }
        }
        $view = new ViewModel(['form' => $form]);
        $view->setTemplate($this->_template . '/' . $page);
        return $view;
    }

    /**
     * Processes doctor feedback
     * @return ViewModel
     **/
    public function doctorFeedbackAction()
    {
        return $this->feedbackForm('doctor-feedback');
    }
    /**
     * Processes practitioner feedback
     * @return ViewModel
     **/
    public function practitionerFeedbackAction()
    {
        return $this->feedbackForm('practitioner-feedback');
    }
    /**
     * Processes patient feedback
     * @return ViewModel
     **/
    public function patientFeedbackAction()
    {
        return $this->feedbackForm('patient-feedback');
    }
    /**
     * Processes patient complaint
     * @return ViewModel
     **/
    public function patientComplaintsAction()
    {
        return $this->feedbackForm('patient-complaints');
    }
} // END class IndexController implements AbstractAdminController