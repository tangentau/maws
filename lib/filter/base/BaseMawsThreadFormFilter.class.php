<?php

/**
 * MawsThread filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsThreadFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'access'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parser_id'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'update_start'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'update_period' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'result_type'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'owner_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'checked_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'access'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parser_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'update_start'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'update_period' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'result_type'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'owner_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'checked_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_thread_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsThread';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'description'   => 'Text',
      'access'        => 'Number',
      'parser_id'     => 'Number',
      'update_start'  => 'Date',
      'update_period' => 'Number',
      'result_type'   => 'Number',
      'owner_id'      => 'ForeignKey',
      'checked_at'    => 'Date',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
