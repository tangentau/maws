<?php


/**
 * Skeleton subclass for representing a row from the 'maws_thread' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sat Mar 20 00:50:38 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MawsThread extends BaseMawsThread {




	// типы результатов
	const	STRING_RES			= 0;		// текстовые данные
	const	FLOAT_RES			= 1;		// числовые данные

	public static $arResultType = array (
											self::STRING_RES => 'Текстовая лента',
											self::FLOAT_RES => 'Числовая лента (график)',
										  );

	const	EVERYONE_ACCESS		= 5001;		// доступен всем
	const	OWNER_ACCESS		= 5002;		// доступен только владельцу
	const	REGISTERED_ACCESS	= 5003;		// доступен только зарегистриоованным

	public static $arAccessType = array (
											self::EVERYONE_ACCESS => 'Все пользователи',
											self::OWNER_ACCESS => 'Только я',
											self::REGISTERED_ACCESS => 'Зарегистрированные пользователи',
										  );

	public static $arUpdatePeriods = array (
											60	  => 'Раз в минуту',
											300	  => 'Раз в 5 минут',
											600	  => 'Раз в 10 минут',
											900	  => 'Раз в 15 минут',
											1800  => 'Раз в полчаса',
											3600  => 'Раз в час',
											7200  => 'Раз в два часа',
											18000  => 'Раз в 5 часов',
											43200  => 'Раз в 12 часов',
											86400  => 'Раз в сутки',
											192800  => 'Раз в двое суток',
										  );

	/**
	 * Initializes internal state of MawsThread object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}


	public function	__toString()
	{
		return $this->getName().' ['.$this->getId().']';
	}

	/**
	 * Загружает парсер, привязанный к треду, выполняет его, и записывает полученный результат в БД
	 * 
	 */
	public function ProcessParse()
	{
		$MawsParser = MawsParserPeer::retrieveByPk($this->getParserId());
		$arMawsParserResults = $MawsParser->Get();

		$oMawsParserResult = new MawsParserResult();
		$oMawsParserResult->setParserId($this->getParserId());
		$oMawsParserResult->setThreadId($this->getId());

		if ($arMawsParserResults != MawsParser::EMPTY_RESOURCE )
		{
			$oMawsParserResult ->setResult(serialize($arMawsParserResults));
			$oMawsParserResult ->setIsDiff(1);
		}
		else
		{
			$oMawsParserResult ->setResult(MawsParser::EMPTY_RESOURCE);
			$oMawsParserResult ->setIsDiff(1);
		}

		$oMawsParserResult ->setResultType($MawsParser->getResultType());
		$oMawsParserResult ->save();
	}

	/**
	 * Возвращает сохранённые в БД записи этого треда
	 *
	 * @param timestamp $start - начало периода, за который вернуть записи
	 * @param timestamp $end - конец периода, за который вернуть записи
	 *
	 */
	public function getParserResults($start = false, $end = false)
	{

		$c = new Criteria();
		$c->add(MawsParserResultPeer::THREAD_ID,$this->getId());
		if ($start !== false)
		{
			$c->add(MawsParserResultPeer::CREATED_AT,$start,Criteria::LESS_THAN);
		}
		if ($end !== false)
		{
			$c->add(MawsParserResultPeer::CREATED_AT,$end,Criteria::GREATER_THAN);
		}
		$c->addDescendingOrderByColumn(MawsParserResultPeer::CREATED_AT);
		$arMawsParserResults = MawsParserResultPeer::doSelect($c);
		return $arMawsParserResults;
	}


	/**
	 * Get the username of the owner.
	 *
	 * @return     string
	 */
	public function getOwnerName()
	{
	  $Owner = sfGuardUserPeer::retrieveByPK($this->getOwnerId());
	  return $Owner->getUsername();
	}

	/**
	 * Get the [result_type] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getResultType($toString = false)
	{
	  if ($toString)
	  {
		return self::$arResultType[$this->result_type];
	  }
	  else
	  {
		return $this->result_type;
	  }
	}



	/**
	 * Get the [access] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getAccess($toString = false)
	{
	  if ($toString)
	  {
		return self::$arAccessType[$this->access];
	  }
	  else
	  {
		return $this->access;
	  }
	}


	/**
	 * Делает массив из параметров, пришедших от формы создания/редактирования ленты
	 *
	 * @param      object $request собственно параметры
	 * @return     array
	 */
	public static function GetFormData($request)
	{
	  	$form = array (
						'id'			  => 'new',
						'name'			  => $request->getParameter('name'),
						'description'	  => $request->getParameter('description'),
						'access'		  => $request->getParameter('access'),
						'result_type'	  => $request->getParameter('result_type'),
						'text_parser'	  => $request->getParameter('text_parser'),
						'number_parser'	  => $request->getParameter('number_parser'),
						'update_start'	  => $request->getParameter('update_start'),
						'update_period'	  => $request->getParameter('update_period'),
		);

		if ($form['result_type'] == self::STRING_RES)
		{
		  $form['parser_id'] = $form['text_parser'];
		}
		else
		{
		  $form['parser_id'] = $form['number_parser'];
		}

		return $form;
	}

	/**
	 * Validates form input data and, if it is correct, creates new MawsThread
	 * @param array $form
	 * @param object $sfUser
	 */
	public function SaveFromForm($form = array(),$sfUser = false)
	{
	  $UserId = $sfUser->getGuardUser()->getId();

	  $errors = array();
	  if (!($UserId>0))
	  {
		$errors[] = 'Не авторизованный пользователь.';
	  }
	  if (strlen($form['name'])<=0)
	  {
		$errors[] = 'Не указано название ленты.';
	  }
	  if ($form['parser_id']<=0)
	  {
		$errors[] = 'Не указан фильтр.';
	  }
	  if (intval($form['update_period'])<60)
	  {
		$errors[] = 'Неверный период обновления ленты.';
	  }



	  if (count($errors)==0)
	  {
		$this->setName($form['name']);
		$this->setDescription($form['description']);
		$this->setAccess($form['access']);
		$this->setParserId($form['parser_id']);
		$this->setUpdatePeriod($form['update_period']);
		$this->setUpdateStart($form['update_start']);
		$this->setResultType($form['result_type']);
		$this->setOwnerId($UserId);
		$this->save();
		return true;
	  }
	  else
	  {
		return $errors;
	  }
	}


	/**
	 * Делает массив из параметров фильтра, для подстановки в поля формы редактирования
	 *
	 * @return     array
	 */
	public function toFormArray()
	{
	  	$form = array (
						'id'			  => $this->getId(),
						'name'			  => $this->getName(),
						'description'	  => $this->getDescription(),
						'access'		  => $this->getAccess(),
						'result_type'	  => $this->getResultType(),
						'parser_id'		  => $this->getParserId(),
						'update_start'	  => $this->getUpdateStart(),
						'update_period'	  => $this->getUpdatePeriod(),
		);

		return $form;
	}

	/**
	 *
	 * Возвращает список тредов, у который последнее обновление было слишком давно (больше, чем период обновления треда)
	 *
	 * @return array - arrqy of IDs of outdated threads
	 */
	public static function getOutdatedThreads()
	{
		$debugPDO = Propel::getConnection();
		$query = 'SELECT ID FROM #1# WHERE (now() - #2# > #3#) OR #2# IS NULL ';
		$query = str_replace('#1#',MawsThreadPeer::TABLE_NAME,$query);
		$query = str_replace('#2#',MawsThreadPeer::CHECKED_AT,$query);
		$query = str_replace('#3#',MawsThreadPeer::UPDATE_PERIOD,$query);

		$statement = $debugPDO->prepare($query);
		$statement->execute(array());
		$thread_ids = $statement->fetchAll();
		
		return $thread_ids;
	}


} // MawsThread
