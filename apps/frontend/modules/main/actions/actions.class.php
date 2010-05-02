<?php

/**
 * page actions.
 *
 * @package    sfproject
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    
  }

  public function executeHelp(sfWebRequest $request)
  {

  }
  public function executeLogout(sfWebRequest $request)
  {
	$this->forward('sfGuardAuth', 'signout');
  }

  public function executeLogin(sfWebRequest $request)
  {
	$this->forward('sfGuardAuth', 'signin');
  }
}
