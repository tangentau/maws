<?php

class mawsCronTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'maws';
    $this->name             = 'cron';
    $this->briefDescription = 'Does cron job: check all outdated threads for new content';
    $this->detailedDescription = <<<EOF
The [maws:cron|INFO] task checks all outdated threads for new content.
Call it with:

  [php symfony maws:cron|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	$this->thread_ids = MawsThread::getOutdatedThreads();

	foreach($this->thread_ids as $thread_id)
	{
		$this->MawsThread = MawsThreadPeer::retrieveByPk($thread_id['ID']);
		$this->MawsThread->ProcessParse();
		$this->MawsThread->setCheckedAt(time());
		$this->MawsThread->save();
	}
  }
}
