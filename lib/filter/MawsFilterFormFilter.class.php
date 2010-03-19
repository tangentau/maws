<?php

/**
 * MawsFilter filter form.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class MawsFilterFormFilter extends BaseMawsFilterFormFilter
{

  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_type'   => new sfWidgetFormFilterInput(),
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
    ));

    $this->widgetSchema->setNameFormat('maws_filter_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }
  
  public function configure()
  {
  }
}
