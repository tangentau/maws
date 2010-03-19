<?php

/**
 * MawsFilter form.
 *
 * @package    sfproject
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class MawsFilterForm extends BaseMawsFilterForm
{

  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'resource'        => new sfWidgetFormInputText(),
      'resource_type'   => new sfWidgetFormInputText(),
      'resource_method' => new sfWidgetFormInputText(),
      'resource_login'  => new sfWidgetFormInputText(),
      'resource_pass'   => new sfWidgetFormInputText(),
      'resource_params' => new sfWidgetFormTextarea(),
      'filter'          => new sfWidgetFormTextarea(),
      'filter_type'     => new sfWidgetFormInputText(),
      'action'          => new sfWidgetFormInputText(),
      'action_type'     => new sfWidgetFormInputText(),
      'action_param1'   => new sfWidgetFormInputText(),
      'action_param2'   => new sfWidgetFormInputText(),
      'action_param3'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'MawsFilter', 'column' => 'id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resource'        => new sfValidatorString(array('max_length' => 255)),
      'resource_type'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resource_method' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resource_login'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resource_pass'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resource_params' => new sfValidatorString(array('required' => false)),
      'filter'          => new sfValidatorString(array('required' => false)),
      'filter_type'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'action'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action_type'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'action_param1'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action_param2'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action_param3'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_filter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function configure()
  {
  }
}
