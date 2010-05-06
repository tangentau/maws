<?php


/**
 * Skeleton subclass for representing a row from the 'maws_page' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Mar 24 21:33:39 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MawsPage extends BaseMawsPage {



	// типы результатов
	const	STRING_RES			= 0;		// текстовые данные
	const	FLOAT_RES			= 1;		// числовые данные

	public static $arResultType = array (
											self::STRING_RES => 'Текстовая сводка',
											self::FLOAT_RES => 'Числовая сводка (набор графиков)',
										  );

	const	EVERYONE_ACCESS		= 5001;		// доступна всем
	const	OWNER_ACCESS		= 5002;		// доступна только владельцу
	const	REGISTERED_ACCESS	= 5003;		// доступна только зарегистриоованным

	public static $arAccessType = array (
											self::EVERYONE_ACCESS => 'Все пользователи',
											self::OWNER_ACCESS => 'Только я',
											self::REGISTERED_ACCESS => 'Зарегистрированные пользователи',
										  );

	public static $arShowPeriods = array (
											300	  => '5 минут',
											600	  => '10 минут',
											1800  => 'Полчаса',
											3600  => 'Час',
											7200  => 'Два часа',
											18000  => 'Пять часов',
											43200  => '12 часов',
											86400  => 'Сутки',
											192800  => 'Двое суток',
											604800  => 'Неделя',
											2592000  => 'Месяц',
										  );

	public static $arGraphColumns = array (
											'mid' => 'Среднее значение',
											'max' => 'Максимальное значение',
											'min' => 'Минимальное значение',
											'sum' => 'Сумма  значений',
											'count' => 'Количество значений',
										  );



	/**
	 * Initializes internal state of MawsPage object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
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
	 * Get the [show_period] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getShowPeriod($toString = false)
	{
	  if ($toString)
	  {
		if (array_key_exists($this->show_period,self::$arShowPeriods))
		{
		  $string = self::$arShowPeriods[$this->show_period];
		}
		else 
		{
		  $string = $this->show_period.' секунд';
		}
		return $string;
	  }
	  else
	  {
		return $this->show_period;
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
	 * Делает массив из параметров, пришедших от формы создания/редактирования сводки
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
						'show_period'	  => $request->getParameter('show_period'),
						'arAddedTextThreads' => $request->getParameter('added_text_threads'),
						'arAddedNumberThreads' => $request->getParameter('added_number_threads'),
						'ar_thread_id'	  => $request->getParameter('thread_id'),
						'ar_thread_sort'  => $request->getParameter('thread_sort'),
						'ar_thread_color' => $request->getParameter('thread_color'),
		);

		if (!is_array($form['arAddedTextThreads']))
		{
		  $form['arAddedTextThreads'] = array();
		}

		if (!is_array($form['arAddedNumberThreads']))
		{
		  $form['arAddedNumberThreads'] = array();
		}
		return $form;
	}


	/**
	 * Validates form input data and, if it is correct, creates new MawsPage
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
		$errors[] = 'Не указано название сводки.';
	  }
	  if (count($form['arAddedTextThreads']) + count($form['arAddedNumberThreads']) <= 0)
	  {
		$errors[] = 'Не указаны ленты, входящие в сводку.';
	  }
	  if (intval($form['show_period'])<300)
	  {
		$errors[] = 'Неверный период показа сводки.';
	  }

	  if (!array_key_exists($form['access'],self::$arAccessType))
	  {
		$form['access'] = self::EVERYONE_ACCESS;
	  }

	  if (count($errors)==0)
	  {
		$this->setName($form['name']);
		$this->setDescription($form['description']);
		$this->setAccess($form['access']);
		$this->setShowPeriod($form['show_period']);
		$this->setResultType($form['result_type']);
		$this->setOwnerId($UserId);
		$this->save();

		if ($form['result_type'] == self::STRING_RES)
		{
		  if ($this->getId() > 0)  $this->deleteThreads();
		  $this->setThreads($form['arAddedTextThreads']);
		}
		else
		{
		  if ($this->getId() > 0)  $this->deleteThreads();
		  $this->setThreads($form['arAddedNumberThreads']);
		}

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
						'show_period'	  => $this->getShowPeriod(),
		);


		$form['arAddedNumberThreads'] = array();
		$form['arAddedTextThreads'] = array();
		
		if ($form['result_type'] == self::STRING_RES)
		{
		  $form['arAddedTextThreads'] = $this->getThreads();
		}
		else
		{
		  $form['arAddedNumberThreads'] = $this->getThreads();
		}

		if (!is_array($form['arAddedNumberThreads'])) $form['arAddedNumberThreads'] = array();
		if (!is_array($form['arAddedTextThreads'])) $form['arAddedTextThreads'] = array();
		
		return $form;
	}

	// добавляет связи Сведка <--> Лента
	public function setThreads($arThreads)
	{
	  foreach ($arThreads as $arThread)
	  {
		$MawsPageThread = new MawsPageThread();
		$MawsPageThread->setMawsPage($this);
		$MawsPageThread->setMawsThreadId($arThread['id']);
		$MawsPageThread->setColor(hexdec($arThread['color']));
		$MawsPageThread->setSortOrder(intval($arThread['sort']));
		$MawsPageThread->save();
	  }
	}

	// удаляет связи Сведка <--> Лента
	public function deleteThreads()
	{
	  $c = new Criteria();
	  $c->add(MawsPageThreadPeer::PAGE_ID, $this->getId(), Criteria::EQUAL);
	  $MawsPageThreads = MawsPageThreadPeer::doSelect($c);
	  foreach ($MawsPageThreads as $MawsPageThread)
	  {
		$MawsPageThread->delete();
	  }
	}

	// находит связи Сведка <--> Лента
	public function getThreads()
	{
	  $arThreads = array();

	  $c = new Criteria();
	  $c->add(MawsPageThreadPeer::PAGE_ID, $this->getId(), Criteria::EQUAL);
	  $MawsPageThreads = MawsPageThreadPeer::doSelect($c);
	  foreach ($MawsPageThreads as $MawsPageThread)
	  {
		$arThread['id'] = $MawsPageThread->getThreadId();
		$arThread['name'] = $MawsPageThread->getMawsThread()->getName();
		$arThread['sort'] = $MawsPageThread->getSortOrder();
		$arThread['color'] = toolBox::toColor($MawsPageThread->getColor());

		$arThreads[$arThread['id']] = $arThread;
	  }
	  return $arThreads;
	}

} // MawsPage
