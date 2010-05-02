<?php

/**
 * parser actions.
 *
 * @package    sfproject
 * @subpackage parser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parserActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$UserId = $this->getUser()->getGuardUser()->getId();
	$c = new Criteria();
	$c->add(MawsParserPeer::OWNER_ID, $UserId, Criteria::EQUAL);
    $this->MawsParsers = MawsParserPeer::doSelect($c);
  }

  public function executeForeign(sfWebRequest $request)
  {
	$UserId = $this->getUser()->getGuardUser()->getId();
	$c = new Criteria();
	$c->add(MawsParserPeer::OWNER_ID, $UserId, Criteria::NOT_EQUAL);
	if ($this->getUser()->isAnon())
	{
	  $c->add(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	}
	else
	{
	  $AccessCriterion = $c->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::EVERYONE_ACCESS, Criteria::EQUAL);
	  $AccessCriterion2 = $c->getNewCriterion(MawsParserPeer::ACCESS, MawsParser::REGISTERED_ACCESS, Criteria::EQUAL);
	  $AccessCriterion->addOr($AccessCriterion2);
	  $c->addAnd($AccessCriterion);
	}
    $this->MawsParsers = MawsParserPeer::doSelect($c);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id'));

	$UserId = $this->getUser()->getGuardUser()->getId();

	$this->access = false;

	if ($this->MawsParser->getOwnerId() == $UserId)
	{
	  $this->owner = true;
	  $this->access = true;
	}
	else
	{
	  if ($this->MawsParser->getAccess() == MawsParser::EVERYONE_ACCESS)
	  {
		$this->access = true;
	  }
	  elseif ($this->MawsParser->getAccess() == MawsParser::REGISTERED_ACCESS)
	  {
		if ($this->getUser()->isAnon()) $this->access = false;
		elseif ($UserId > 0) $this->access = true;
	  }
	  elseif ($this->MawsParser->getAccess() == MawsParser::OWNER_ACCESS)
	  {
		if ($this->MawsParser->getOwnerId() == $UserId) $this->access = true;
		else $this->access = false;
	  }

	  $this->owner = false;
	}

	$this->MawsParserOwner = sfGuardUserPeer::retrieveByPK($this->MawsParser->getOwnerId());
	$this->strOwnerName = $this->MawsParserOwner->getUsername();
	$this->arMawsParserResults = $this->MawsParser->Get();
	$this->strMawsParserContent = $this->MawsParser->getContent();
    $this->forward404Unless($this->MawsParser);
  }

  public function executeNew(sfWebRequest $request)
  {
	$this->errors = array();
	
	if ($request->getParameter('id') == 'new') // сохраняем новый фильтр
	{
	  $MawsParser = new MawsParser();
	  $this->form = $MawsParser->GetFormData($request);
	  $res = $MawsParser->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('parser/edit?id='.$MawsParser->getId()); // успешно создали новый парсер
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку добавления
		$this->errors = $res; // а тут будут сообщения об ошибках при создании фильтра
	  }
	}
	else // показываем пустую формочку
	{
	  if ($this->getUser()->isAnon())
	  {
		$arAccess[MawsParser::EVERYONE_ACCESS] = MawsParser::$arAccessType[MawsParser::EVERYONE_ACCESS];
	  }
	  else
	  {
		$arAccess = MawsParser::$arAccessType;
	  }
	  $arAccessKeys = array_keys(MawsParser::$arAccessType);
	  $arResultKeys = array_keys(MawsParser::$arResultType);
	  $arResourceKeys = array_keys(MawsParser::$arResourceType);
	  $arMethodKeys = array_keys(MawsParser::$arResourceMethod);
	  $arFilterKeys = array_keys(MawsParser::$arFilterType);
	  $arActionKeys = array_keys(MawsParser::$arActionType);

	  $this->form = array (
							'id'			  => 'new',
							'name'			  => 'Безымянный фильтр',
							'description'	  => '',
							'access'		  => $arAccessKeys[0],
							'arAccessType'	  => $arAccess,
							'result_type'	  => $arResultKeys[0],
							'resource_type'	  => $arResourceKeys[0],
							'resource_url'	  => '',
							'resource_param_name'  => array('0'=>''),
							'resource_param_value'  => array('0'=>''),
							'resource_login'  => '',
							'resource_pass'	  => '',
							'resource_method' => $arMethodKeys[0],
							'filter_type'	  => $arFilterKeys[0],
							'filter_params'	  => MawsParser::$arFilterParams,
							'action_type'	  => $arActionKeys[0],
							'action_params'	  => array	(
														  'n'=>'1',
														  'm'=>'1',
												  ),
	  );
	}
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MawsParserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsParser does not exist (%s).', $request->getParameter('id')));

	$UserId = $this->getUser()->getGuardUser()->getId();
	if ($MawsParser->getOwnerId() == $UserId)
	{
	  $this->owner = true;
	}
	else
	{
	  $this->owner = false;
	}
	$this->id = $MawsParser->getId();

	$this->arMawsParserResults = $MawsParser->Get();
	$this->strMawsParserContent = $MawsParser->getContent();

	$this->errors = array();
	$this->form_action = 'save';

	if ($request->getParameter('form_action') == 'save') // сохраняем изменения
	{
	  $this->form = $MawsParser->GetFormData($request);
	  $res = $MawsParser->SaveFromForm($this->form,$this->getUser());


	  if ($res === true)
	  {
		$this->redirect('parser/edit?id='.$this->id); // успешно сохранили парсер
	  }
	  else
	  {
		// никуда не редиректим, а показываем всё ту же формочку редактирования
		$this->errors = $res; // а тут будут сообщения об ошибках при редактировании фильтра
	  }
	}
	else // показываем формочку
	{
	  $this->form = $MawsParser->toFormArray();

	  if ($this->getUser()->isAnon())
	  {
		$arAccess[MawsParser::EVERYONE_ACCESS] = MawsParser::$arAccessType[MawsParser::EVERYONE_ACCESS];
	  }
	  else
	  {
		$arAccess = MawsParser::$arAccessType;
	  }
	  $this->form['arAccessType'] = $arAccess;
	}

  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsParser does not exist (%s).', $request->getParameter('id')));
    $this->form = new MawsParserForm($MawsParser);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
	$this->errors = array();
    $request->checkCSRFProtection();

	$this->forward404Unless($MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsParser does not exist (%s).', $request->getParameter('id')));

	try {
      $MawsParser->delete();
      $this->redirect('parser/index');
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
      $MawsParser = $form->save();

      $this->redirect('parser/edit?id='.$MawsParser->getId());
    }
  }
}
