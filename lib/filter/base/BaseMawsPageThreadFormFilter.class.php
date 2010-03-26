<?php

/**
 * MawsPageThread filter form base class.
 *
 * @package    sfproject
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMawsPageThreadFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'page_id'     => new sfWidgetFormPropelChoice(array('model' => 'MawsPage', 'add_empty' => true)),
      'thread_id'   => new sfWidgetFormPropelChoice(array('model' => 'MawsThread', 'add_empty' => true)),
      'sort_order'  => new sfWidgetFormFilterInput(),
      'show_period' => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'page_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsPage', 'column' => 'id')),
      'thread_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MawsThread', 'column' => 'id')),
      'sort_order'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_period' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('maws_page_thread_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MawsPageThread';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'page_id'     => 'ForeignKey',
      'thread_id'   => 'ForeignKey',
      'sort_order'  => 'Number',
      'show_period' => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
