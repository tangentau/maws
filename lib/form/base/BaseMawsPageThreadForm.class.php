<?php

/**
 * MawsPageThread form base class.
 *
 * @method MawsPageThread getObject() Returns the current form's model object
 *
 * @package    sfproject
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsPageThreadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'page_id'     => new sfWidgetFormPropelChoice(array('model' => 'MawsPage', 'add_empty' => false)),
      'thread_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => false)),
      'sort_order'  => new sfWidgetFormInputText(),
      'show_period' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'MawsPageThread', 'column' => 'id', 'required' => false)),
      'page_id'     => new sfValidatorPropelChoice(array('model' => 'MawsPage', 'column' => 'id')),
      'thread_id'   => new sfValidatorPropelChoice(array('model' => 'MawsThread', 'column' => 'id')),
      'sort_order'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'show_period' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('maws_page_thread[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsPageThread';
  }


}
