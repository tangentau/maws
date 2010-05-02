<?php

class sfGuardFormSignin extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInput(array('label' => 'Имя пользователя:')),
      'password' => new sfWidgetFormInput(array('label' => 'Пароль:', 'type' => 'password')),
      //'remember' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(array(),array('required' => 'Введите имя пользователя.')),
      'password' => new sfValidatorString(array(),array('required' => 'Введите пароль.')),
      'remember' => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(new sfGuardValidatorUser());

    $this->widgetSchema->setNameFormat('signin[%s]');
  }
}
