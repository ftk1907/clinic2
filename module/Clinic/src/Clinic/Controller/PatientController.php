<?php
namespace Clinic\Controller;
use Zend\View\Model\ViewModel;

/**
 * Index Controller
 *
 * @package Clinic\Controller
 * @author
 **/
class PatientController extends BaseEntityController
{

    public function __construct($entityManager, $repository, $entityName)
    {
        parent::__construct($entityManager, $repository, $entityName);
    }

    /**
     * verify a patient
     *
     * @return ViewModel
     **/
    public function verifyAction()
    {
        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action' => 'index',
        ]);

        $id     = $this->params('id');
        $entity = $this->_repository->find($id);

        if(!is_null($entity)) {
            $entity->setVerified(!$entity->getVerified());
            $this->_entityManager->persist($entity);
            $this->_entityManager->flush();
            return $this->getMessagePage('success', 'Action applied', $url);
        }

        return $this->getMessagePage('error', 'Invalid URL', $url);
    }

} // END class IndexController implements AbstractAdminController