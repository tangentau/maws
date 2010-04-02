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
    $this->forward404Unless($this->MawsParser);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MawsParserForm();
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
    $this->form = new MawsParserForm($MawsParser);
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
