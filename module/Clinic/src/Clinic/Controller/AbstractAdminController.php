<?php
namespace Clinic\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class AbstractAdminController extends AbstractActionController
{
    /**
     * Shows a message page then redirects to url
     * @var $page 'success' or 'error' page
     * @var $message message to display
     * @var $url url to redirect to
     * @return error page with automatic redirect to url
     */
    public function getMessagePage($page, $message, $url)
    {
        $view = new ViewModel(['url' => $url, 'message' => $message]);
        $view->setTemplate("clinic/generic/{$page}");
        return $view;
    }
    /**
     * returns index page with a list of all the persisted objects of an entity.
     * @return Zend\View\Model\ViewModel
     **/
    // public abstract function indexAction();
    /**
     * Create: returns form page of entity
     * on submit: persists entity
     * on success: route to profileAction
     * on error: route to indexAction
     * @return Zend\View\Model\ViewModel
     */
    public abstract function addAction();
    /**
     * Read: returns a page with dependant child entity pages.
     * i.e: Doctor page with Appointments and Practitioners
     * on error: route to indexAction
     * @return Zend\View\Model\ViewModel
     */
    public abstract function profileAction();
    /**
     * Update: updates entity and returns profile
     * on submit: persists entity
     * on success: route to profileAction
     * on error: route to indexAction
     * @return Zend\View\Model\ViewModel
     */
    public abstract function editAction();
    /**
     * Delete: removes an entity with given id parameter
     * on error/success: route to indexAction
     * @return Zend\View\Model\ViewModel
     */
    public abstract function deleteAction();
}