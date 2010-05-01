<?php

/**
 * MawsThread form base class.
 *
 * @method MawsThread getObject() Returns the current form's model object
 *
 * @package    maws
 * @subpackage form
 * @author     tangentau
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsThreadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'access'        => new sfWidgetFormInputText(),
      'parser_id'     => new sfWidgetFormInputText(),
      'update_start'  => new sfWidgetFormDateTime(),
      'update_period' => new sfWidgetFormInputText(),
      'result_type'   => new sfWidgetFormInputText(),
      'owner_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'checked_at'    => new sfWidgetFormDateTime(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'MawsThread', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'access'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'parser_id'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'update_start'  => new sfValidatorDateTime(),
      'update_period' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'result_type'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'owner_id'      => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'checked_at'    => new sfValidatorDateTime(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_thread[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsThread';
  }


}
