<?php

/**
 * page_thread actions.
 *
 * @package    sfproject
 * @subpackage page_thread
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class page_threadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->MawsPageThreads = MawsPageThreadPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsPageThread = MawsPageThreadPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->MawsPageThread);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsPageThreadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsPageThreadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsPageThread = MawsPageThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPageThread does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsPageThreadForm($MawsPageThread);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsPageThread = MawsPageThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPageThread does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsPageThreadForm($MawsPageThread);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsPageThread = MawsPageThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPageThread does not exist (%s).', $request->getParameter('id')));
    $MawsPageThread->delete();

    $this->redirect('page_thread/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $MawsPageThread = $form->save();

      $this->redirect('page_thread/edit?id='.$MawsPageThread->getId());
    }
  }
}
