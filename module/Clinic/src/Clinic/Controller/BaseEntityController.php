<?php
namespace Clinic\Controller;
use Zend\View\Model\ViewModel;

class BaseEntityController extends AbstractEntityController
{
    protected $_entityManager;
    protected $_repository;
    protected $_entityName;
    protected $_template;

    function __construct($entityManager, $repository, $entityName)
    {
        $this->_entityManager = $entityManager;
        $this->_entityName    = $entityName;
        $this->_repository    = $repository;
        $this->_template      = "clinic/generic/{$entityName}";
    }

    /**
     * @inheritdoc
     */
    public function indexAction()
    {
        $entity = $this->_repository->findAll();
        $view   = new ViewModel([$this->_entityName . 's' => $entity]);
        $view->setTemplate($this->_template . '/all');
        return $view;
    }

    /**
     * @inheritdoc
     */
    public function profileAction()
    {
        $id     = $this->params('id');
        $entity = $this->_repository->find($id);

        if(!$entity) {
           $url = $this->url()->fromRoute('admin', [
                'controller' => $this->_entityName,
                'action'     => 'index',
            ]);
           return $this->getMessagePage('error', 'Id not found', $url);
        }

        $view = new ViewModel([$this->_entityName => $entity]);
        $view->setTemplate($this->_template . '/profile');
        return $view;
    }

    /**
     * @inheritdoc
     */
    public function deleteAction()
    {
        $id     = $this->params('id');
        $entity = $this->_repository->find($id);
        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action' => 'index',
        ]);

        if(!$entity) {
            return $this->getMessagePage('error', 'Id not found', $url);
        }

        try {
            $this->_entityManager->remove($entity);
            $this->_entityManager->flush();
            return $this->getMessagePage(
                'success', "{$this->_entityName} with id {$id} was deleted!", $url
            );
        } catch (\Exception $e) {
            $errorCode = $e->getPrevious()->getCode();
            return $this->getMessagePage('error', "[$errorCode]: {$this->_entityName} was not to deleted!", $url);
        }
    }

    /**
     * @inheritdoc
     */
    public function addAction()
    {
        $request = $this->getRequest();
        $form = $this->getServiceLocator()->get($this->_entityName.'RegisterForm');
        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action'     => 'add',
        ]);
        $form->setAttribute('action', $url);
        if ( $request->isPost() ) {
            $form->setData($request->getPost());
            if( $form->isValid() ) {
                try {
                    $object = $form->getObject();
                    $this->_entityManager->persist($object);
                    $this->_entityManager->flush();
                    $profile = $this->url()->fromRoute('admin', [
                            'controller' => $this->_entityName,
                            'action'     => 'profile',
                            'id'         => $object->getId()
                        ]
                    );
                    return $this->getMessagePage('success', "{$this->_entityName} is successfully registered", $profile);
                }
                catch (Exception $e) {
                    return $this->getMessagePage('error', 'An error occurred, form was not processed', $url);
                }
            }
        }
        $view = new ViewModel(['form' => $form]);
        $view->setTemplate($this->_template . '/form');
        return $view;
    }

    /**
     * @inheritdoc
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id');

        $url = $this->url()->fromRoute('admin', [
            'controller' => $this->_entityName,
            'action'     => 'edit',
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

        $form = $this->getServiceLocator()->get($this->_entityName.'RegisterForm');
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
        $view->setTemplate($this->_template . '/form');
        return $view;
    }
}