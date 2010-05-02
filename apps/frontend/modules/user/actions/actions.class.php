<?php

/**
 * user actions.
 *
 * @package    maws
 * @subpackage user
 * @author     tangentau
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sfGuardUsers = sfGuardUserPeer::doSelect(new Criteria());
	$this->UserId = $this->getUser()->getGuardUser()->getId();
	if ($this->getUser()->isAnon())
  	{
	  $this->UserId = false;
	}
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id'));
	$UserId = $this->getUser()->getGuardUser()->getId();
	if ($this->getUser()->isAnon())
  	{
	  $UserId = false;
	}
	if ($UserId)
	if ($this->sfGuardUser->getId() == $UserId)
	{
	  $this->owner = true;
	}
	else
	{
	  $this->owner = false;
	}
    $this->forward404Unless($this->sfGuardUser);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sfGuardUser);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sfGuardUser);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
    $sfGuardUser->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sfGuardUser = $form->save();

      $this->redirect('user/edit?id='.$sfGuardUser->getId());
    }
  }
}
