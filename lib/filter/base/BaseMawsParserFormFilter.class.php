<?php

/**
 * MawsParser filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsParserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'access'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_url'    => new sfWidgetFormFilterInput(),
      'resource_type'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_params' => new sfWidgetFormFilterInput(),
      'resource_method' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_login'  => new sfWidgetFormFilterInput(),
      'resource_pass'   => new sfWidgetFormFilterInput(),
      'filter_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filter_params'   => new sfWidgetFormFilterInput(),
      'action_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_params'   => new sfWidgetFormFilterInput(),
      'result_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'owner_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'access'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_url'    => new sfValidatorPass(array('required' => false)),
      'resource_type'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_params' => new sfValidatorPass(array('required' => false)),
      'resource_method' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_login'  => new sfValidatorPass(array('required' => false)),
      'resource_pass'   => new sfValidatorPass(array('required' => false)),
      'filter_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'filter_params'   => new sfValidatorPass(array('required' => false)),
      'action_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'action_params'   => new sfValidatorPass(array('required' => false)),
      'result_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'owner_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_parser_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsParser';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'description'     => 'Text',
      'access'          => 'Number',
      'resource_url'    => 'Text',
      'resource_type'   => 'Number',
      'resource_params' => 'Text',
      'resource_method' => 'Number',
      'resource_login'  => 'Text',
      'resource_pass'   => 'Text',
      'filter_type'     => 'Number',
      'filter_params'   => 'Text',
      'action_type'     => 'Number',
      'action_params'   => 'Text',
      'result_type'     => 'Number',
      'owner_id'        => 'ForeignKey',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
