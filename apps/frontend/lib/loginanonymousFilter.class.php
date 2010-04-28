<?php
/**
 * Log in the user if he is an anonymous.
 */
class loginanonymousFilter extends sfFilter
{
  public function execute($filterChain)
  {
    // Execute this filter only once
    if ($this->isFirstCall())
    {
      // Filters don't have direct access to the request and user objects.
      // You will need to use the context object to get them
      $request = $this->getContext()->getRequest();
      $user    = $this->getContext()->getUser();

      if ($user->isAnonymous())
	  {
		$this->getContext()->getLogger()->info('$user->isAnonymous()');
		$class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
		$this->form = new $class();

		if ($request->isMethod('post'))
		{
		  $this->form->bind($request->getParameter('signin'));
		  if ($this->form->isValid())
		  {
			return $this->getContext()->getController()->forward('main', 'login');
		  }
		}
		else
		{
		  $this->getContext()->getLogger()->info('not_POST');
		  $AnonymousLogin = sfConfig::get('app_anonymous_login', 'anonymous');
		  $c = new Criteria();
		  $c->add(sfGuardUserPeer::USERNAME, $AnonymousLogin, Criteria::LIKE);
		  $obUser = sfGuardUserPeer::doSelectOne($c);
		  $this->getContext()->getLogger()->info($obUser);
		  //$obUser = sfGuardUserPeer::retrieveByPK(2);
		  $user->signin($obUser);
		}
      }
	}
    // Execute next filter
    $filterChain->execute();

  }
}
?>
