<?php

class myUser extends sfGuardSecurityUser
{

  public function isAnon()
  {
	$AnonymousLogin = sfConfig::get('app_anonymous_login', 'anonymous');
	if ($this->getUsername() == $AnonymousLogin)
	{
	  return true;
	}
	else return false;
  }
}
