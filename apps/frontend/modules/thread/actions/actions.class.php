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

	foreach ($this->MawsThreads as $i => $MawsThread)
	{
	  $MawsParser = MawsParserPeer::retrieveByPK($MawsThread->getParserId());

	  if ($MawsParser)
	  {
		$this->MawsThreads[$i]->strParserName = $MawsParser->getName();
	  }
	  else
	  {
		$this->MawsThreads[$i]->strParserName = 'фильтр не найден';
	  }
	}
  }

  public function executeForeign(sfWebRequest $request)
  {
	$UserId = $this->getUser()->getGuardUser()->getId();
	$c = new Criteria();
	$c->add(MawsThreadPeer::OWNER_ID, $UserId, Criteria::NOT_EQUAL);
	if ($this->getUser()->isAnon())
	{
	  $c->add(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c->getNewCriterion(MawsThreadPeer::ACCESS, MawsThread::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c->addAnd($AccessCriterion);
	}

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

	  $MawsParser = MawsParserPeer::retrieveByPK($MawsThread->getParserId());
	  $this->MawsThreads[$i]->strParserName = $MawsParser->getName();
	}
  }

  public function executeShow(sfWebRequest $request)
  {
	$this->MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id'));
	$UserId = $this->getUser()->getGuardUser()->getId();
	if ($this->MawsThread->getOwnerId() == $UserId)
	{
	  $this->owner = true;
	}
	else
	{
	  $this->owner = false;
	}
	$this->id = $request->getParameter('id');

	$MawsParser = MawsParserPeer::retrieveByPK($this->MawsThread->getParserId());
	if ($MawsParser)
	{
		$this->MawsThread->strParserName = $MawsParser->getName();
	}
	$this->MawsThreadContent =  $this->MawsThread->getParserResults();
    $this->forward404Unless($this->MawsThread);
  }

  public function executeNew(sfWebRequest $request)
  {
	$this->errors = array();

	$arAccessKeys = array_keys(MawsThread::$arAccessType);
	$arResultKeys = array_keys(MawsThread::$arResultType);
	if ($this->getUser()->isAnon())
	{
	  $arAccess[MawsThread::EVERYONE_ACCESS] = MawsThread::$arAccessType[MawsThread::EVERYONE_ACCESS];
	}
	else
	{
	  $arAccess = MawsThread::$arAccessType;
	}

	$UserId = $this->getUser()->getGuardUser()->getId();
	
	$c_text = new Criteria();

	if ($this->getUser()->isAnon())
	{
	  $c_text->add(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c_text->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c_text->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c_text->addAnd($AccessCriterion);
	}

	$c_number = clone $c_text;
	
	$c_text->add(MawsParserPeer::RESULT_TYPE, MawsParser::STRING_RES, Criteria::EQUAL);
	$c_number->add(MawsParserPeer::RESULT_TYPE, MawsParser::FLOAT_RES, Criteria::EQUAL);

    $this->MawsTextParsers = MawsParserPeer::doSelect($c_text);
	$this->MawsNumberParsers = MawsParserPeer::doSelect($c_number);

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
		
		$arTextParsers = array();
		foreach ($this->MawsTextParsers as $i => $MawsTextParser)
		{
		  $arTextParsers[$MawsTextParser->getId()] = '['.$MawsTextParser->getId().'] '.$MawsTextParser->getName();
		}

		$arNumberParsers = array();
		foreach ($this->MawsNumberParsers as $i => $MawsNumberParser)
		{
		  $arNumberParsers[$MawsNumberParser->getId()] = '['.$MawsNumberParser->getId().'] '.$MawsNumberParser->getName();
		}
		$this->form['arTextParsers'] = $arTextParsers;
		$this->form['arNumberParsers'] = $arNumberParsers;
		$this->form['arAccessType'] = $arAccess;
		$this->errors = $res; // а тут будут сообщения об ошибках при создании ленты
	  }
	}
	else // показываем пустую формочку
	{
	  $text_parser = 0;
	  $arTextParsers = array();
	  foreach ($this->MawsTextParsers as $i => $MawsTextParser)
	  {
		if (!$text_parser) { $text_parser = $MawsTextParser->getId(); }
		$arTextParsers[$MawsTextParser->getId()] = '['.$MawsTextParser->getId().'] '.$MawsTextParser->getName();
	  }

	  $number_parser = 0;
	  $arNumberParsers = array();
	  foreach ($this->MawsNumberParsers as $i => $MawsNumberParser)
	  {
		if (!$number_parser) { $number_parser = $MawsNumberParser->getId(); }
		$arNumberParsers[$MawsNumberParser->getId()] = '['.$MawsNumberParser->getId().'] '.$MawsNumberParser->getName();
	  }

	  $this->form = array (
							'id'			  => 'new',
							'name'			  => 'Безымянная лента',
							'result_type'	  => MawsThread::STRING_RES,
							'text_parser'	  => $text_parser,
							'number_parser'	  => $number_parser,
							'arTextParsers'	  => $arTextParsers,
							'arNumberParsers' => $arNumberParsers,
							'description'	  => '',
							'access'		  => $arAccessKeys[0],
							'arAccessType'	  => $arAccess,
							'result_type'	  => $arResultKeys[0],
							'update_period'	  => 3600,
							'update_start'	  => date('Y-m-d H:i:s'),
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

	$UserId = $this->getUser()->getGuardUser()->getId();

	if ($MawsThread->getOwnerId() == $UserId)
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

	$UserId = $this->getUser()->getGuardUser()->getId();


	if ($this->getUser()->isAnon())
	{
	  $arAccess[MawsThread::EVERYONE_ACCESS] = MawsThread::$arAccessType[MawsThread::EVERYONE_ACCESS];
	}
	else
	{
	  $arAccess = MawsThread::$arAccessType;
	}


	$c_text = new Criteria();

	if ($this->getUser()->isAnon())
	{
	  $c_text->add(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c_text->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c_text->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c_text->addAnd($AccessCriterion);
	}

	$c_number = clone $c_text;
	
	$c_text->add(MawsParserPeer::RESULT_TYPE, MawsParser::STRING_RES, Criteria::EQUAL);
	$c_number->add(MawsParserPeer::RESULT_TYPE, MawsParser::FLOAT_RES, Criteria::EQUAL);

    $this->MawsTextParsers = MawsParserPeer::doSelect($c_text);
	$this->MawsNumberParsers = MawsParserPeer::doSelect($c_number);


	$arTextParsers = array();
	foreach ($this->MawsTextParsers as $i => $MawsTextParser)
	{
	  $arTextParsers[$MawsTextParser->getId()] = '['.$MawsTextParser->getId().'] '.$MawsTextParser->getName();
	}

	$arNumberParsers = array();
	foreach ($this->MawsNumberParsers as $i => $MawsNumberParser)
	{
	  $arNumberParsers[$MawsNumberParser->getId()] = '['.$MawsNumberParser->getId().'] '.$MawsNumberParser->getName();
	}

	if ($request->getParameter('form_action') == 'save') // сохраняем изменения
	{
	  $this->form = $MawsThread->GetFormData($request);

	  $this->form['arTextParsers']	  = $arTextParsers;
	  $this->form['arNumberParsers']  = $arNumberParsers;
	  $this->form['arAccessType']	  = $arAccess;
	  
	  $res = $MawsThread->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('thread/edit?id='.$MawsThread->getId()); // успешно сохранили ленту
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку добавления
		$this->errors = $res; // а тут будут сообщения об ошибках при создании ленты
	  }
	}
	else // показываем формочку
	{

	  $this->form = $MawsThread->toFormArray();
	  $this->form['arTextParsers']	  = $arTextParsers;
	  $this->form['arNumberParsers']  = $arNumberParsers;
	  $this->form['arAccessType']	  = $arAccess;
	  $this->form['text_parser']	  = $this->form['parser_id'];
	  $this->form['number_parser']	  = $this->form['parser_id'];
	}
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
	$this->errors = array();
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsThread = MawsThreadPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsThread does not exist (%s).', $request->getParameter('id')));
    
	try {
			$MawsThread->delete();
			$this->redirect('thread/index');
	}
	catch (PropelException $e)
	{
	  $this->errors[] = $e->GetMessage();
	  $this->errors[] = 'Возможно, эта лента используется одной или несколькими сводками. Измените настройки сводок так, чтобы это лента не использовалась ни одной сводкой, и тогда её можно будет удалить.';
	}

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
