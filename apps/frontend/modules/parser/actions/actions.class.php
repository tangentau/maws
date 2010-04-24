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

  public function executeShow(sfWebRequest $request)
  {
    $this->MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id'));
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
							'result_type'	  => $arResultKeys[0],
							'resource_type'	  => $arResourceKeys[0],
							'resource_url'	  => '',
							'resource_param_name'  => array('0'=>''),
							'resource_param_value'  => array('0'=>''),
							'resource_login'  => '',
							'resource_pass'	  => '',
							'resource_method' => $arMethodKeys[0],
							'filter_type'	  => $arFilterKeys[0],
							'filter_params'	  => array	(
														  'regexp'=>'',
														  'domselect'=>'',
														  'start_marker'=>'',
														  'end_marker'=>'',
												  ),
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

	$this->errors = array();
	$this->form_action = 'save';

	if ($request->getParameter('form_action') == 'save') // сохраняем изменения
	{
	  $this->form = $MawsParser->GetFormData($request);
	  $res = $MawsParser->SaveFromForm($this->form,$this->getUser());
	  if ($res === true)
	  {
		$this->redirect('parser/edit?id='.$MawsParser->getId()); // успешно сохранили парсер
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
    $request->checkCSRFProtection();

    $this->forward404Unless($MawsParser = MawsParserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object MawsParser does not exist (%s).', $request->getParameter('id')));
    $MawsParser->delete();

    $this->redirect('parser/index');
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
