<?php

/**
 * MawsParserResult form base class.
 *
 * @method MawsParserResult getObject() Returns the current form's model object
 *
 * @package    maws
 * @subpackage form
 * @author     tangentau
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsParserResultForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'parser_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsParser', 'add_empty' => false)),
      'thread_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => false)),
      'result_type' => new sfWidgetFormInputText(),
      'result'      => new sfWidgetFormTextarea(),
      'is_diff'     => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'MawsParserResult', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parser_id'   => new sfValidatorPropelChoice(array('model' => 'MawsParser', 'column' => 'id')),
      'thread_id'   => new sfValidatorPropelChoice(array('model' => 'MawsThread', 'column' => 'id')),
      'result_type' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'result'      => new sfValidatorString(array('required' => false)),
      'is_diff'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_parser_result[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsParserResult';
  }


}
