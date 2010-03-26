<?php

/**
 * MawsFilterResult form base class.
 *
 * @method MawsFilterResult getObject() Returns the current form's model object
 *
 * @package    sfproject
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsFilterResultForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'filter_id'  => new sfWidgetFormPropelChoice(array('model' => 'MawsFilter', 'add_empty' => false)),
      'thread_id'  => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => false)),
      'result'     => new sfWidgetFormTextarea(),
      'is_diff'    => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'MawsFilterResult', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'filter_id'  => new sfValidatorPropelChoice(array('model' => 'MawsFilter', 'column' => 'id')),
      'thread_id'  => new sfValidatorPropelChoice(array('model' => 'MawsThread', 'column' => 'id')),
      'result'     => new sfValidatorString(array('required' => false)),
      'is_diff'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_filter_result[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsFilterResult';
  }


}
