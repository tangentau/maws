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
	  $this->UserId = 0;
	  $this->isAnonymous = true;
	}
	else
	{
	  $this->UserName = $this->user->getUsername();
	  $this->UserId = $this->user->getGuardUser()->getId();
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
	$this->user = $this->getUser();

	$this->Anonymous = sfConfig::get('app_anonymous_login', 'anonymous');

	if ($this->user->isAnonymous())
	{
	  $this->UserId = 0;
	  $this->isAnonymous = true;
	}
	else
	{
	  $this->UserName = $this->user->getUsername();
	  $this->UserId = $this->user->getGuardUser()->getId();
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

}