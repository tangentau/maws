<?php

/**
 * testuser actions.
 *
 * @package    sfproject
 * @subpackage testuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testuserActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->SfGuardUsers = sfGuardUserPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->SfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->SfGuardUser);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($SfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardUser does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfGuardUserForm($SfGuardUser);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($SfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardUser does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfGuardUserForm($SfGuardUser);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($SfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardUser does not exist (%s).', $request->getParameter('id')));
    $SfGuardUser->delete();

    $this->redirect('testuser/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $SfGuardUser = $form->save();

      $this->redirect('testuser/edit?id='.$SfGuardUser->getId());
    }
  }
}
