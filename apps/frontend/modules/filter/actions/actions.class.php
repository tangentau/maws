<?php

/**
 * filter actions.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->MawsFilters = MawsFilterPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsFilter = MawsFilterPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->MawsFilter);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsFilterForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsFilterForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsFilter = MawsFilterPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilter does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsFilterForm($MawsFilter);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsFilter = MawsFilterPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilter does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsFilterForm($MawsFilter);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsFilter = MawsFilterPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilter does not exist (%s).', $request->getParameter('id')));
    $MawsFilter->delete();

    $this->redirect('filter/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $MawsFilter = $form->save();

      $this->redirect('filter/edit?id='.$MawsFilter->getId());
    }
  }
}
