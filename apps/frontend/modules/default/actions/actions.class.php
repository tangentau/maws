<?php

/**
 * default actions.
 *
 * @package    sfproject
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->SfTests = SfTestPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->SfTest = SfTestPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->SfTest);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SfTestForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SfTestForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($SfTest = SfTestPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfTest does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfTestForm($SfTest);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($SfTest = SfTestPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfTest does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfTestForm($SfTest);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($SfTest = SfTestPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfTest does not exist (%s).', $request->getParameter('id')));
    $SfTest->delete();

    $this->redirect('default/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $SfTest = $form->save();

      $this->redirect('default/edit?id='.$SfTest->getId());
    }
  }
}
