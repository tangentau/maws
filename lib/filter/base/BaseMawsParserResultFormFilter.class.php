<?php

/**
 * MawsParserResult filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsParserResultFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'parser_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsParser', 'add_empty' => true)),
      'thread_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => true)),
      'result_type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'result'      => new sfWidgetFormFilterInput(),
      'is_diff'     => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'parser_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsParser', 'column' => 'id')),
      'thread_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsThread', 'column' => 'id')),
      'result_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'result'      => new sfValidatorPass(array('required' => false)),
      'is_diff'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_parser_result_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsParserResult';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'parser_id'   => 'ForeignKey',
      'thread_id'   => 'ForeignKey',
      'result_type' => 'Number',
      'result'      => 'Text',
      'is_diff'     => 'Number',
      'created_at'  => 'Date',
    );
  }
}
