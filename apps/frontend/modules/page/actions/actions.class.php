<?php

/**
 * page actions.
 *
 * @package    sfproject
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->MawsPages = MawsPagePeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->MawsPage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsPageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsPageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPage does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsPageForm($MawsPage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPage does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsPageForm($MawsPage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPage does not exist (%s).', $request->getParameter('id')));
    $MawsPage->delete();

    $this->redirect('page/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $MawsPage = $form->save();

      $this->redirect('page/edit?id='.$MawsPage->getId());
    }
  }
}
