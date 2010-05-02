<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
  public function executeSignin($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
	  $Anonymous = sfConfig::get('app_anonymous_login', 'anonymous');
	  if ($user->getUsername() != $Anonymous)
	  {
		return $this->redirect('@homepage');
	  }
    }
	else
	{
	  if ($request->isMethod('post'))
	  {
	  }
	  else
	  {
		$AnonymousLogin = sfConfig::get('app_anonymous_login', 'anonymous');
		$c = new Criteria();
		$c->add(sfGuardUserPeer::USERNAME, $AnonymousLogin, Criteria::EQUAL);
		$obUser = sfGuardUserPeer::doSelectOne($c);
		$user->signin($obUser);
	  }

	}

    if ($request->isXmlHttpRequest())
    {
      $this->getResponse()->setHeaderOnly(true);
      $this->getResponse()->setStatusCode(401);

      return sfView::NONE;
    }

    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->form = new $class();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

        // always redirect to a URL set in app.yml
        // or to the referer
        // or to the homepage
        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage'));

        return $this->redirect($signinUrl);
      }
    }
    else
    {
      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }
}
