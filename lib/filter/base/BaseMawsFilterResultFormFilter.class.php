<?php

/**
 * MawsFilterResult filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsFilterResultFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(),
      'filter_id'  => new sfWidgetFormPropelChoice(array('model' => 'MawsFilter', 'add_empty' => true)),
      'thread_id'  => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => true)),
      'result'     => new sfWidgetFormFilterInput(),
      'is_diff'    => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'filter_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsFilter', 'column' => 'id')),
      'thread_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsThread', 'column' => 'id')),
      'result'     => new sfValidatorPass(array('required' => false)),
      'is_diff'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_filter_result_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsFilterResult';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'filter_id'  => 'ForeignKey',
      'thread_id'  => 'ForeignKey',
      'result'     => 'Text',
      'is_diff'    => 'Number',
      'created_at' => 'Date',
    );
  }
}
