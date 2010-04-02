<?php

class mainComponents extends sfComponents
{
  public function executeAuthHeader()
  {
	$this->user = $this->getUser();

	$this->Anonymous = sfConfig::get('app_anonymous_login', 'anonymous');
	$class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->login_form = new $class();
	
	if ($this->user->isAnonymous())
	{
	  $this->UserName = 'error'; //$this->Anonymous;
	  $this->isAnonymous = true;
	}
	else
	{
	  $this->UserName = $this->user->getUsername();
	  if ($this->UserName == $this->Anonymous)
	  {
		$this->isAnonymous = true;
	  }
	  else
	  {
		$this->isAnonymous = false;
	  }
	}
  }

  public function executeMenuHeader()
  {
  }

}