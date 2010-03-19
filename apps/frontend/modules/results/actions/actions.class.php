<?php

/**
 * results actions.
 *
 * @package    sfproject
 * @subpackage results
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resultsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->MawsFilterResults = MawsFilterResultPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsFilterResult = MawsFilterResultPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->MawsFilterResult);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsFilterResultForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsFilterResultForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsFilterResult = MawsFilterResultPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilterResult does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsFilterResultForm($MawsFilterResult);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsFilterResult = MawsFilterResultPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilterResult does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsFilterResultForm($MawsFilterResult);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsFilterResult = MawsFilterResultPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsFilterResult does not exist (%s).', $request->getParameter('id')));
    $MawsFilterResult->delete();

    $this->redirect('results/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $MawsFilterResult = $form->save();

      $this->redirect('results/edit?id='.$MawsFilterResult->getId());
    }
  }
}
