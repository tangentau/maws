<?php

/**
 * thread actions.
 *
 * @package    sfproject
 * @subpackage thread
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class threadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->MawsThreads = MawsThreadPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id'));
	$this->MawsThreadContent =  $this->MawsThread->getParserResults();
    $this->forward404Unless($this->MawsThread);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsThreadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsThreadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsThread does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsThreadForm($MawsThread);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsThread does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsThreadForm($MawsThread);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsThread does not exist (%s).', $request->getParameter('id')));
    $MawsThread->delete();

    $this->redirect('thread/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $MawsThread = $form->save();

      $this->redirect('thread/edit?id='.$MawsThread->getId());
    }
  }

  public function executeCheck(sfWebRequest $request)
  {

	$this->thread_ids = MawsThread::getOutdatedThreads();

	foreach($this->thread_ids as $thread_id)
	{
		$this->MawsThread = MawsThreadPeer::retrieveByPk($thread_id['ID']);
		$this->MawsThread->ProcessParse();
		$this->MawsThread->setCheckedAt(time());
		$this->MawsThread->save();
	}
  }
}
