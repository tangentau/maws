<?php

/**
 * page actions.
 *
 * @package    maws
 * @subpackage page
 * @author     tangentau
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$UserId = $this->getUser()->getGuardUser()->getId();
	
	$c = new Criteria();
	$c->add(MawsPagePeer::OWNER_ID, $UserId, Criteria::EQUAL);
    $this->MawsPages = MawsPagePeer::doSelect($c);
  }

  public function executeForeign(sfWebRequest $request)
  {

	$UserId = $this->getUser()->getGuardUser()->getId();

	$c = new Criteria();
	$c->add(MawsPagePeer::OWNER_ID, $UserId, Criteria::NOT_EQUAL);

	if ($this->getUser()->isAnon())
	{
	  $c->add(MawsPagePeer::ACCESS, MawsPage::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c->getNewCriterion(MawsPagePeer::ACCESS, MawsPage::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c->getNewCriterion(MawsPagePeer::ACCESS, MawsPage::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c->addAnd($AccessCriterion);
	}
	
    $this->MawsPages = MawsPagePeer::doSelect($c);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id'));

	$UserId = $this->getUser()->getGuardUser()->getId();

	if ($this->MawsPage->getOwnerId() == $UserId)
	{
	  $this->owner = true;
	}
	else
	{
	  $this->owner = false;
	}

	$this->MawsPageThreads = $this->MawsPage->getThreads();

	$this->MawsPageResults = array();
	foreach ($this->MawsPageThreads as $i => $MawsPageThread)
	{
	  $MawsThread = MawsThreadPeer::retrieveByPk($MawsPageThread['id']);
	  $this->MawsPageThreads[$i]['thread'] = $MawsThread;
	  $this->MawsPageThreads[$i]['parser_results']  = $MawsThread->getParserResults();
	  foreach ($this->MawsPageThreads[$i]['parser_results'] as $MawsParserResult)
	  {
		if (!isset($this->MawsPageResults[$MawsParserResult->getCreatedAt()]))
		{
		  $this->MawsPageResults[$MawsParserResult->getCreatedAt()] = array();
		}

		$this->MawsPageResults[$MawsParserResult->getCreatedAt()][$MawsPageThread['id']] = unserialize($MawsParserResult->getResult());

	  }
	}


    $this->forward404Unless($this->MawsPage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->errors = array();


	$arAccessKeys = array_keys(MawsPage::$arAccessType);
	$arResultKeys = array_keys(MawsPage::$arResultType);

	$UserId = $this->getUser()->getGuardUser()->getId();


	if ($this->getUser()->isAnon())
	{
	  $arAccess[MawsPage::EVERYONE_ACCESS] = MawsPage::$arAccessType[MawsPage::EVERYONE_ACCESS];
	}
	else
	{
	  $arAccess = MawsPage::$arAccessType;
	}

	$c_text = new Criteria();

	if ($this->getUser()->isAnon())
	{
	  $c_text->add(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c_text->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c_text->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c_text->addAnd($AccessCriterion);
	}

	$c_number = clone $c_text;

	$c_text->add(MawsThreadPeer::RESULT_TYPE, MawsThread::STRING_RES, Criteria::EQUAL);
	$c_number->add(MawsThreadPeer::RESULT_TYPE, MawsThread::FLOAT_RES, Criteria::EQUAL);

    $this->MawsTextThreads = MawsThreadPeer::doSelect($c_text);
	$this->MawsNumberThreads = MawsThreadPeer::doSelect($c_number);

	$arTextThreads= array();
	foreach ($this->MawsTextThreads as $i => $MawsTextThread)
	{
	  $arTextThreads[$MawsTextThread->getId()] = '['.$MawsTextThread->getId().'] '.$MawsTextThread->getName();
	}

	$arNumberThreads = array();
	foreach ($this->MawsNumberThreads as $i => $MawsNumberThread)
	{
	  $arNumberThreads[$MawsNumberThread->getId()] = '['.$MawsNumberThread->getId().'] '.$MawsNumberThread->getName();
	}

	
    if ($request->getParameter('id') == 'new') // сохраняем новую сводку
	{
	  $MawsPage = new MawsPage();
	  $this->form = $MawsPage->GetFormData($request);
	  $res = $MawsPage->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('page/edit?id='.$MawsPage->getId()); // успешно создали новую сводку
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку добавления
		$this->form['arTextThreads'] = $arTextThreads;
		$this->form['arNumberThreads'] = $arNumberThreads;
		$this->form['arAccessType'] = $arAccess;
		$this->errors = $res; // а тут будут сообщения об ошибках при создании ленты
	  }
	}
	else // показываем пустую формочку
	{

	  $arAddedTextThreads = array();
	  $arAddedNumberThreads = array();
	  
	  $this->form = array (
							'id'			  => 'new',
							'name'			  => 'Безымянная сводка',
							'result_type'	  => MawsThread::STRING_RES,
							'arTextThreads'	  => $arTextThreads,
							'arNumberThreads' => $arNumberThreads,
							'arAddedTextThreads'	  => $arAddedTextThreads,
							'arAddedNumberThreads'	  => $arAddedNumberThreads,
							'description'	  => '',
							'access'		  => $arAccessKeys[0],
							'arAccessType'	  => $arAccess,
							'result_type'	  => $arResultKeys[0],
							'show_period'	  => 3600,
	  );
	}

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

	$UserId = $this->getUser()->getGuardUser()->getId();

	if ($MawsPage->getOwnerId() == $UserId)
	{
	  $this->owner = true;
	}
	else
	{
	  $this->owner = false;
	}
	$this->id = $request->getParameter('id');
	$this->errors = array();
	$this->form_action = 'save';

	$arAccessKeys = array_keys(MawsPage::$arAccessType);
	$arResultKeys = array_keys(MawsPage::$arResultType);

	$UserId = $this->getUser()->getGuardUser()->getId();


	if ($this->getUser()->isAnon())
	{
	  $arAccess[MawsPage::EVERYONE_ACCESS] = MawsPage::$arAccessType[MawsPage::EVERYONE_ACCESS];
	}
	else
	{
	  $arAccess = MawsPage::$arAccessType;
	}

	$c_text = new Criteria();

	if ($this->getUser()->isAnon())
	{
	  $c_text->add(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c_text->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c_text->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c_text->addAnd($AccessCriterion);
	}

	$c_number = clone $c_text;

	$c_text->add(MawsThreadPeer::RESULT_TYPE, MawsThread::STRING_RES, Criteria::EQUAL);
	$c_number->add(MawsThreadPeer::RESULT_TYPE, MawsThread::FLOAT_RES, Criteria::EQUAL);

    $this->MawsTextThreads = MawsThreadPeer::doSelect($c_text);
	$this->MawsNumberThreads = MawsThreadPeer::doSelect($c_number);

	$arTextThreads= array();
	foreach ($this->MawsTextThreads as $i => $MawsTextThread)
	{
	  $arTextThreads[$MawsTextThread->getId()] = '['.$MawsTextThread->getId().'] '.$MawsTextThread->getName();
	}

	$arNumberThreads = array();
	foreach ($this->MawsNumberThreads as $i => $MawsNumberThread)
	{
	  $arNumberThreads[$MawsNumberThread->getId()] = '['.$MawsNumberThread->getId().'] '.$MawsNumberThread->getName();
	}


    if ($request->getParameter('form_action') == 'save') // сохраняем изменения
	{
	  $this->form = $MawsPage->GetFormData($request);
	  $res = $MawsPage->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('page/edit?id='.$MawsPage->getId()); // успешно создали новую сводку
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку добавления
		$this->form['arTextThreads'] = $arTextThreads;
		$this->form['arNumberThreads'] = $arNumberThreads;
		$this->form['arAccessType'] = $arAccess;
		$this->errors = $res; // а тут будут сообщения об ошибках при создании ленты
	  }
	}
	else // показываем формочку
	{
	  $this->form = $MawsPage->toFormArray();
	  $this->form['arTextThreads'] = $arTextThreads;
	  $this->form['arNumberThreads'] = $arNumberThreads;
	  $this->form['arAccessType'] = $arAccess;

	}

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
	$this->errors = array();
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsPage = MawsPagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsPage does not exist (%s).', $request->getParameter('id')));

	try {
	  $MawsPage->deleteThreads();
	  $MawsPage->delete();
	  $this->redirect('page/index');
	}
	catch (PropelException $e)
	{
	  $this->errors[] = $e->GetMessage();
	}

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
