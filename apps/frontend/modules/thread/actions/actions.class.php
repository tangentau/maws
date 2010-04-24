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
	$UserId = $this->getUser()->getGuardUser()->getId();
	$c = new Criteria();
	$c->add(MawsThreadPeer::OWNER_ID, $UserId, Criteria::EQUAL);
    $this->MawsThreads = MawsThreadPeer::doSelect($c);

	$arOwners = array();

	foreach ($this->MawsThreads as $i => $MawsThread)
	{
	  $OwnerId = $MawsThread->getOwnerId();
	  if (!array_key_exists($OwnerId, $arOwners))
	  {
		$arOwners[$OwnerId] = sfGuardUserPeer::retrieveByPK($OwnerId);
	  }

	  $this->MawsThreads[$i]->strOwnerName = $arOwners[$OwnerId]->getUsername();
	  
	  $MawsParser = MawsParserPeer::retrieveByPK($MawsThread->getFilterId());
	  $this->MawsThreads[$i]->strFilterName = $MawsParser->getName();
	}
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id'));
	$this->MawsThreadContent =  $this->MawsThread->getParserResults();
    $this->forward404Unless($this->MawsThread);
  }

  public function executeNew(sfWebRequest $request)
  {
    if ($request->getParameter('id') == 'new') // сохраняем новую ленту
	{
	  $MawsThread = new MawsThread();
	  $this->form = $MawsThread->GetFormData($request);
	  $res = $MawsThread->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('thread/edit?id='.$MawsThread->getId()); // успешно создали новую ленту
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку добавления
		$this->errors = $res; // а тут будут сообщения об ошибках при создании ленты
	  }
	}
	else // показываем пустую формочку
	{
	  $arAccessKeys = array_keys(MawsParser::$arAccessType);
	  $arResultKeys = array_keys(MawsParser::$arResultType);

	  $this->form = array (
							'id'			  => 'new',
							'name'			  => 'Безымянная лента',
							'filter_id'		  => 0,
							'description'	  => '',
							'access'		  => $arAccessKeys[0],
							'result_type'	  => $arResultKeys[0],
	  );
	}
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
