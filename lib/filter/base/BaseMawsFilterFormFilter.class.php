<?php

/**
 * MawsFilter filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsFilterFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(),
      'resource'        => new sfWidgetFormFilterInput(),
      'resource_type'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_method' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_login'  => new sfWidgetFormFilterInput(),
      'resource_pass'   => new sfWidgetFormFilterInput(),
      'resource_params' => new sfWidgetFormFilterInput(),
      'filter'          => new sfWidgetFormFilterInput(),
      'filter_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action'          => new sfWidgetFormFilterInput(),
      'action_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_param1'   => new sfWidgetFormFilterInput(),
      'action_param2'   => new sfWidgetFormFilterInput(),
      'action_param3'   => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'resource'        => new sfValidatorPass(array('required' => false)),
      'resource_type'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_method' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_login'  => new sfValidatorPass(array('required' => false)),
      'resource_pass'   => new sfValidatorPass(array('required' => false)),
      'resource_params' => new sfValidatorPass(array('required' => false)),
      'filter'          => new sfValidatorPass(array('required' => false)),
      'filter_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'action'          => new sfValidatorPass(array('required' => false)),
      'action_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'action_param1'   => new sfValidatorPass(array('required' => false)),
      'action_param2'   => new sfValidatorPass(array('required' => false)),
      'action_param3'   => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_filter_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsFilter';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'resource'        => 'Text',
      'resource_type'   => 'Number',
      'resource_method' => 'Number',
      'resource_login'  => 'Text',
      'resource_pass'   => 'Text',
      'resource_params' => 'Text',
      'filter'          => 'Text',
      'filter_type'     => 'Number',
      'action'          => 'Text',
      'action_type'     => 'Number',
      'action_param1'   => 'Text',
      'action_param2'   => 'Text',
      'action_param3'   => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
