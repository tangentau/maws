<?php

/**
 * MawsParser form base class.
 *
 * @method MawsParser getObject() Returns the current form's model object
 *
 * @package    sfproject
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsParserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormInputText(),
      'access'          => new sfWidgetFormInputText(),
      'resource_url'    => new sfWidgetFormInputText(),
      'resource_type'   => new sfWidgetFormInputText(),
      'resource_params' => new sfWidgetFormTextarea(),
      'resource_method' => new sfWidgetFormInputText(),
      'resource_login'  => new sfWidgetFormInputText(),
      'resource_pass'   => new sfWidgetFormInputText(),
      'filter_type'     => new sfWidgetFormInputText(),
      'filter_params'   => new sfWidgetFormTextarea(),
      'action_type'     => new sfWidgetFormInputText(),
      'action_params'   => new sfWidgetFormTextarea(),
      'result_type'     => new sfWidgetFormInputText(),
      'owner_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'MawsParser', 'column' => 'id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'access'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resource_url'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resource_type'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resource_params' => new sfValidatorString(array('required' => false)),
      'resource_method' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'resource_login'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'resource_pass'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'filter_type'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'filter_params'   => new sfValidatorString(array('required' => false)),
      'action_type'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'action_params'   => new sfValidatorString(array('required' => false)),
      'result_type'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'owner_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_parser[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsParser';
  }


}
