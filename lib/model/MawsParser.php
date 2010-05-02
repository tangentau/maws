<?php


/**
 * Skeleton subclass for representing a row from the 'maws_parser' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Mar 24 21:33:38 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */

class MawsParser extends BaseMawsParser {

/************************************** КОНСТАНТЫ КЛАССА *******************************/

/*** доступ к фильтру: ***/

	const	EVERYONE_ACCESS		= 5001;		// доступен всем
	const	OWNER_ACCESS		= 5002;		// доступен только владельцу
	const	REGISTERED_ACCESS	= 5003;		// доступен только зарегистриоованным

	public static $arAccessType = array (
											self::EVERYONE_ACCESS => 'Все пользователи',
											self::OWNER_ACCESS => 'Только я',
											self::REGISTERED_ACCESS => 'Зарегистрированные пользователи',
										  );

/*** варианты обращений к http. K.O. ***/

	const	METHOD_GET			= 6001;
	const	METHOD_POST			= 6002;

	public static $arResourceMethod= array (
											self::METHOD_GET => 'GET',
											self::METHOD_POST => 'POST',
										  );

/*** типы ИИС: ***/

	const	HTTP_RESOURCE		= 7001;		// страница HTTP-сервера
	const	FTP_RESOURCE		= 7002;		// каталог FTP-сервера
	const	HTTP_FILE_RESOURCE	= 7003;		// файл на HTTP-сервере
	const	FTP_FILE_RESOURCE	= 7004;		// файл на FTP-сервере
	const	FILTER_RESOURCE		= 7005;		// другой фильтр

	public static $arResourceType = array (
											self::HTTP_RESOURCE => 'http-страница',
											self::FTP_RESOURCE => 'ftp-каталог',
											self::HTTP_FILE_RESOURCE => 'http-файл',
											self::FTP_FILE_RESOURCE => 'ftp-файл',
											self::FILTER_RESOURCE => 'фильтр MAWS',
										  );

/*** типы фильтров данных, полученных от ИИС: ***/

	const	REGEXP_FILTER		= 8001;		// старые добрые регулярки
	const	DOM_FILTER			= 8002;		// фильтр DOM-cтруктуры HTML-документа
	const	MATCH_FILTER		= 8003;		// ищем то, что внутри маркеров (начального и закрывающего)

	public static $arFilterType = array (
											self::REGEXP_FILTER => 'Регулярное выражение',
											self::DOM_FILTER => 'XML-анализ',
											self::MATCH_FILTER => 'Указание маркеров',
										  );

	// варианты выборки результатов разбора документа по регулярке

	const	ALL_REGEXP			= 0;		// берём $matches[0] из результатов работы preg_match_all
	const	FIRST_SUBSET		= 1;		// берём $matches[1] из результатов работы preg_match_all
	const	SECOND_SUBSET		= 2;		// берём $matches[2] из результатов работы preg_match_all
	const	THIRD_SUBSET		= 3;		// берём $matches[3] из результатов работы preg_match_all


	public static $arRegexpFilterType = array (
											self::ALL_REGEXP => 'Полное соответствие выражению',
											self::FIRST_SUBSET => 'Только первое внутреннее соответствие',
											self::SECOND_SUBSET => 'Только второе внутреннее соответствие',
											self::THIRD_SUBSET => 'Только третье внутреннее соответствие',
										  );


	// варианты выборки результатов разбора документа по XPATH

	const	DOM_NODEVALUE		= 0;		//  nodeValue()
	const	DOM_ATTRVALUE		= 1;		// getAttribute()

	public static $arXpathFilterType = array (
											self::DOM_NODEVALUE => 'Содержимое элемента',
											self::DOM_ATTRVALUE => 'Атрибут элемента',
										  );


	// значения по умолчанию для параметров фильтра
	public static $arFilterParams =		array (
											'regexp' => '<p>(.*?)</p>',
											'regexp_type' => self::ALL_REGEXP,
											'xpath' => '//p',
											'xpath_param' => self::DOM_NODEVALUE,
											'dom_attr' => 'class',
											'start_marker' => '<p>',
											'end_marker' => '</p>',
										  );

/*** типы действий над отфильтрованными данными (arFilterResult): ***/

	const	GET_ALL				= 9001;		// взять все результаты фильтрации
	const	GET_FIRST_N			= 9002;		// взять первые N результатов фильтрации
	const	GET_LAST_N			= 9003;		// взять последние N результатов фильтрации
	const	GET_COUNT			= 9004;		// взять количество результатов фильтрации
	const	GET_RANDOM			= 9005;		// взять рандомный результат фильтрации (один или несколько)
	const	GET_MNTH			= 9006;		// взять N-ный результат фильтрации и M результатов после него

	public static $arActionType = array (
											self::GET_ALL => 'Взять все результаты',
											self::GET_FIRST_N => 'Взять N первых результатов',
											self::GET_LAST_N => 'Взять N последних результатов',
											self::GET_COUNT => 'Взять число результатов',
											self::GET_RANDOM => 'Взять случайный результат',
											self::GET_MNTH => 'Взять M результатов после N',
										  );

	// типы результатов
	const	STRING_RES			= 0;		// текстовые данные
	const	FLOAT_RES			= 1;		// числовые данные

	public static $arResultType = array (
											self::STRING_RES => 'Текст',
											self::FLOAT_RES => 'Число',
										  );

/*** прочие константы ****/

	const	ERROR_RESULT		= -1;		// значение ошибки по умолчанию
	const	EMPTY_RESOURCE		= -1025;	// значение неинициализированного ИИС
	const	EMPTY_FILTER_RESULT	= -1026;	// значение неинициализированного результата фильтра
	const	EMPTY_ACTION_RESULT	= -1027;	// значение неинициализированной выборки (результата действий)

	const	MAX_REDIRECTS		= 5;		// макс. число редиректов cURL

	const	MAX_TIMEOUT			= 3;		// макс. время таймаута cURL

/************************************** РАБОЧИЕ ПЕРЕМЕННЫЕ КЛАССА *******************************/


/*** используемый ИИС: ***/

	/*
	protected	$resource_type = self::HTTP_RESOURCE;			// тип ИИС
	protected	$resource_url = 'http://www.example.com';
	protected	$resource_method = self::METHOD_GET;						// как обращаться к HTTP_RESOURCE
	protected	$resource_params = '';						// для HTTP_RESOURCE
	protected	$resource_login = '';
	protected	$resource_password = '';
*/

/*** данные, полученных от ИИС: ***/

	protected $strContent 	= self::EMPTY_RESOURCE;

/*** фильтр данных, полученных от ИИС: ***/
	protected	$filter_type = self::REGEXP_FILTER;				// тип фильтра
	protected	$filter_params = '';							// собственно фильтр


/*** результат фильтрации ***/

	protected $arFilterResult = array(self::EMPTY_FILTER_RESULT);

/*** действия над отфильтрованными данными ***/
	protected	$action_type = self::GET_MNTH;					// тип действий

/*** результат работы класса ***/

	protected $arActionResult	= array(self::EMPTY_ACTION_RESULT);


	public $debug = array();

/************************************** МЕТОДЫ КЛАССА *******************************/

	/*
	public function __construct()
	{
		parent::__construct();
		$this->resource_type = self::HTTP_RESOURCE;			// тип ИИС
		$this->resource = 'http://www.example.com';
		$this->resource_method = 'GET';						// как обращаться к HTTP_RESOURCE
		$this->resource_params = array();						// для HTTP_RESOURCE
		$this->resource_login = '';
		$this->resource_password = '';

		$this->filter_type = self::REGEXP_FILTER;				// тип фильтра
		$this->filter_string = '';							// собственно фильтр

		$this->action_type = self::GET_MNTH;					// тип действий
		$this->action_param1 = 2;								// первый параметр
		$this->action_param2 = 2;								// первый параметр
		$this->action_param3 = 2;								// первый параметр

	}
*/

	/**
	 * Initializes internal state of MawsParser object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}


	/**
	 * Делает массив из параметров, пришедших от формы создания/редактирования фильтра
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
						'resource_type'	  => $request->getParameter('resource_type'),
						'resource_url'	  => $request->getParameter('resource_url'),
						'resource_param_name' => $request->getParameter('resource_param_name'),
						'resource_param_value' => $request->getParameter('resource_param_value'),
						'resource_login'  => $request->getParameter('resource_login'),
						'resource_pass'	  => $request->getParameter('resource_pass'),
						'resource_method' => $request->getParameter('resource_method'),
						'filter_type'	  => $request->getParameter('filter_type'),
						'filter_params'	  => $request->getParameter('filter_params'),
						'action_type'	  => $request->getParameter('action_type'),
						'action_params'	  => $request->getParameter('action_params'),
		);

		$form['resource_params'] = array();

		unset($form['resource_param_name']['#i#']);
		unset($form['resource_param_value']['#i#']);

		foreach ($form['resource_param_name'] as $i => $name)
		{
		  $form['resource_params'][$name] = $form['resource_param_value'][$i];
		}


		return $form;
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
						'resource_type'	  => $this->getResourceType(),
						'resource_url'	  => $this->getResourceUrl(),
						'resource_params' => unserialize($this->getResourceParams()),
						'resource_login'  => $this->getResourceLogin(),
						'resource_pass'	  => $this->getResourcePass(),
						'resource_method' => $this->getResourceMethod(),
						'filter_type'	  => $this->getFilterType(),
						'filter_params'	  => unserialize($this->getFilterParams()),
						'action_type'	  => $this->getActionType(),
						'action_params'	  => unserialize($this->getActionParams()),
		);

		
		$form['resource_param_name'] = array();
		$form['resource_param_value'] = array();

		foreach ($form['resource_params'] as $name => $value)
		{
		  $form['resource_param_name'][] = $name;
		  $form['resource_param_value'][] = $value;
		}

		foreach (self::$arFilterParams as $key => $default_value)
		if (!isset($form['filter_params'][$key] ))
		{
		  $form['filter_params'][$key] = $default_value;
		}

		return $form;
	}


	/**
	 * Validates form input data and, if it is correct, creates new MawsParser
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
		$errors[] = 'Не указано название фильтра.';
	  }
	  if (strlen($form['resource_url'])<=0)
	  {
		$errors[] = 'Не указан URL.';
	  }
	  if ($form['filter_type']==self::REGEXP_FILTER)
	  {
		if (strlen($form['filter_params']['regexp'])==0)
		 {
		  $errors[] = 'Не задано регулярное выражение.';
		 }
	  }

	  if ($form['filter_type']==self::DOM_FILTER)
	  {
		if (strlen($form['filter_params']['xpath'])==0)
		 {
		  $errors[] = 'Не задан Xpath-селектор.';
		 }
	  }

	  if (strlen(implode('',$form['filter_params']))==0)
	  {
		$errors[] = 'Не указаны параметры фильтра.';
	  }
	  if (strlen(implode('',$form['action_params']))==0) // параметры N и M не указаны
	  {
		if (in_array($form['action_type'],array(self::GET_FIRST_N,self::GET_LAST_N,self::GET_MNTH))) // но действие над результатами таково, что они требуются
		{
		  $errors[] = 'Не указаны параметры действий над результатами фильтра.';
		}
	  }

	  if (count($errors)==0)
	  {
		$this->setName($form['name']);
		$this->setDescription($form['description']);
		$this->setAccess($form['access']);
		$this->setFilterType($form['filter_type']);
		$this->setFilterParams(serialize($form['filter_params']));
		$this->setResourceType($form['resource_type']);
		$this->setResourceUrl($form['resource_url']);
		$this->setResourceMethod($form['resource_method']);
		$this->setResourceLogin($form['resource_login']);
		$this->setResourcePass($form['resource_pass']);
		$this->setResourceParams(serialize($form['resource_params']));
		$this->setResultType($form['result_type']);
		$this->setActionType($form['action_type']);
		$this->setActionParams(serialize($form['action_params']));
		$this->setOwnerId($UserId);
		$this->save();
		return true;
	  }
	  else
	  {
		return $errors;
	  }
	}

	public function	__toString()
	{
		return $this->getName().' ['.$this->getId().']';
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
	 * Get the [action_type] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getActionType($toString = false)
	{
	  if ($toString)
	  {
		return self::$arActionType[$this->action_type];
	  }
	  else
	  {
		return $this->action_type;
	  }
	}

	/**
	 * Get the [action_params] column value.
	 *
	 * @param      bool $toArray cast value to array ot not
	 * @return     mixed
	 */
	public function getActionParams($toArray = false)
	{
	  if ($toArray)
	  {
		return unserialize($this->action_params);
	  }
	  else
	  {
		return $this->action_params;
	  }
	}

	/**
	 * Get the [resource_type] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getResourceType($toString = false)
	{
	  if ($toString)
	  {
		return self::$arResourceType[$this->resource_type];
	  }
	  else
	  {
		return $this->resource_type;
	  }
	}


	/**
	 * Get the [resource_method] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getResourceMethod($toString = false)
	{
	  if ($toString)
	  {
		return self::$arResourceMethod[$this->resource_method];
	  }
	  else
	  {
		return $this->resource_method;
	  }
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
	 * Get the [resource_params] column value.
	 *
	 * @param      bool $toArray cast value to array ot not
	 * @return     mixed
	 */
	public function getResourceParams($toArray = false)
	{
	  if ($toArray)
	  {
		return unserialize($this->resource_params);
	  }
	  else
	  {
		return $this->resource_params;
	  }
	}

	/**
	 * Get the [filter_params] column value.
	 *
	 * @param      bool $toArray cast value to array ot not
	 * @return     mixed
	 */
	public function getFilterParams($toArray = false)
	{
	  if ($toArray)
	  {
		return unserialize($this->filter_params);
	  }
	  else
	  {
		return $this->filter_params;
	  }
	}


	/**
	 * Get the [filter_type] column value.
	 *
	 * @param      bool $toString cast value to string ot not
	 * @return     int
	 */
	public function getFilterType($toString = false)
	{
	  if ($toString)
	  {
		return self::$arFilterType[$this->filter_type];
	  }
	  else
	  {
		return $this->filter_type;
	  }
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
	 * Получает контент информационного источника (ИИС).
	 * ИИС может быть веб-страничкой, каталогом ftp-сервера, файлом или фильтром.
	 *
	 **/
	public function ReadResource()
	{
		$this->debug[] = '-___'.$this->resource_type;

		$strRes = self::ERROR_RESULT;

		switch ($this->resource_type)		// смотрим тип информационного источника
		{
			case self::HTTP_RESOURCE:			// страничка на http-сервере
			{
				$strRes = $this->ReadHttpResource();
				break;
			}
			case self::FTP_RESOURCE:			// папка на ftp-сервере
			{
				$strRes = $this->ReadFtpResource();
				break;
			}
			case self::HTTP_FILE_RESOURCE:		// файл на http-сервере
			{
				$strRes = $this->ReadHttpFileResource();
				break;
			}
			case self::FTP_FILE_RESOURCE:		// файл на ftp-сервере
			{
				$strRes = $this->ReadFtpFileResource();
				break;
			}
			case self::FILTER_RESOURCE:			// другой фильтр  MawsFilter
			{
				$strRes = $this->ReadFilterResource();
				break;
			}
			default:
			{
				$strRes = $this->ReadHttpResource();
				break;
			}
		}

		// $this->strContent contains the output string
		$this->debug[] = '=='.$strRes;
		$this->strContent = $strRes;

		return $this;
	}


	/**
	 * Геттер.
	 *
	 *
	 **/
	public function getContent()
	{
		return $this->strContent;
	}

	/**
	 * Фильтрует полученный контент ИИС.
	 * ИИС может быть веб-страничкой, каталогом ftp-сервера, файлом или фильтром,
	 * а фильтр может быть регекспом, DOM- или CSS- шаблоном.
	 *
	 **/
	public function DoFilter()
	{

		$arFilterParams = unserialize($this->filter_params);
		foreach ($arFilterParams as $i => $val)
		{
		  $arFilterParams[strtoupper($i)] = $val;
		}
		
		switch ($this->filter_type)		// смотрим тип фильтра: как именно нужно отфильтровать контент?
		{
			case self::MATCH_FILTER:			// оставляем только то, что между начальными и загрывающими маркерами
			{

				$arFilterResult = explode($arFilterParams['START_MARKER'],$this->strContent); // разрезаем контент на кусочки после открывающего маркера

				// НО! т.к. explode разрезает строку на куски До и После, то первый кусок из полученных всегда будет лишним.
				// Поэтому при записи результатов будем переписывать все куски, кроме первого.

				if (count($arFilterResult>1)) // если у нас хоть что-то подходящее нашлось
				{
					$this->arFilterResult = array();
					//$this->debug[] = ' $arFilterResult match_filter: '.var_export($arFilterResult,1);

					foreach ($arFilterResult as $i => $strMatch) // в каждом из полученных кусочков
					{
						if ($i>0)				// кроме первого
						{
							$pos = strpos($strMatch,$arFilterParams['END_MARKER']); // ищем закрывающий маркер

							if (!($pos===false)) // маркер найден
							{
								$strMatch = substr($strMatch, 0, $pos); // откидываем всё, что после маркера
								$this->arFilterResult[] = $strMatch;
							}
						}
					}

					// теперь из всего контента осталось только то, что между начальными и закрывающими маркерами
				}
				else	// ничего не нашлось
				{
					// оставляем $this->arFilterResult таким, как есть (т.е. пустым)
				}

				break;
			}
			case self::REGEXP_FILTER:	// оставляем только то, что подходит под регулярное выражение
			{
				$arMatches = array();
				preg_match_all('/'.$arFilterParams['REGEXP'].'/',$this->strContent,$arMatches);
				if ((isset($arMatches[$arFilterParams['REGEXP_TYPE']])) && (is_array($arMatches[$arFilterParams['REGEXP_TYPE']])))
					$this->arFilterResult = $arMatches[$arFilterParams['REGEXP_TYPE']];
				break;
			}
			case self::DOM_FILTER:	// оставляем только то, что подходит под XPATH
			{
				$arMatches = array();
				$dom = new DOMDocument();
				@$dom->loadHTML($this->strContent);
				$xpath = new DOMXPath($dom);
				$result_rows = $xpath->query($arFilterParams['XPATH']);

				//here we loop through our results (a DOMDocument Object)
				foreach ($result_rows as $result_object)
				{
				  if ($arFilterParams['XPATH_PARAM'] == self::DOM_NODEVALUE)
				  {
					$arMatches[] = $result_object->nodeValue;
				  }
				  else if ($arFilterParams['XPATH_PARAM'] == self::DOM_ATTRVALUE)
				  {
					$arMatches[] = $result_object->getAttribute($arFilterParams['DOM_ATTR']);
				  }
				}

				$this->arFilterResult = $arMatches;
				
				break;
			}
			default:			// ничего не фильтруем
			{
				$this->arFilterResult = array($this->strContent);
				break;
			}
		}
		return $this;
	}

	/**
	 * Отбирает полученные результаты фильтрации контента ИИС.
	 * Берёт все результаты, или несколько первых, или возвращает количество результатов и т.д.
	 *
	 **/
	public function DoActions()
	{

		$arActionParams = unserialize($this->action_params);

		if (isset($arActionParams['n'])) $n = $arActionParams['n'];

		if (isset($arActionParams['m'])) $m = $arActionParams['m'];

		switch ($this->action_type)		// смотрим, что конкретно нужно сделать с результатами
		{
			case self::GET_ALL:			// оставляем все результаты
			{
				$this->arActionResult = $this->arFilterResult;
				break;
			}
			case self::GET_FIRST_N:			// оставляем первые N результатов
			{
				$arResult = array();

				for ($i = 0; $i < $n; $i++)
				{
				  if (isset($this->arFilterResult[$i]))
					$arResult[] = $this->arFilterResult[$i];
				}
				$this->arActionResult = $arResult;
				break;
			}
			case self::GET_LAST_N:			// оставляем последние N результатов
			{
				$arResult = array();
				$count = count($this->arFilterResult);
				for ($i = $count - $n; $i < $count; $i++)
				{
				  if (isset($this->arFilterResult[$i]))
					$arResult[] = $this->arFilterResult[$i];
				}
				$this->arActionResult = $arResult;
				break;
			}
			case self::GET_COUNT:		// количество результатов
			{
				$this->arActionResult = array(count($this->arFilterResult));
				break;
			}
			case self::GET_RANDOM:	//
			{
				$arResult = array();
				$count = count($this->arFilterResult);
				$i=0;
				while ($i<1)
				{
				  $rand = rand(0,count($this->arFilterResult));
				  if (isset($this->arFilterResult[$rand]))
				  {
				  	$arResult[] = $this->arFilterResult[$rand];
					$i++;
				  }
				}
				$this->arActionResult = $arResult;
				break;
			}
			case self::GET_MNTH:	// взять N результатов после M
			{
				$arResult = array();

				for ($i = $n; $i < $m+$n; $i++)
				{
				  if (isset($this->arFilterResult[$i]))
					$arResult[] = $this->arFilterResult[$i];
				}
				$this->arActionResult = $arResult;
				break;
			}
			default:					// оставляем все результаты
			{
				$this->arActionResult = $this->arFilterResult;
				break;
			}
		}

		return $this;
	}

	/**
	 * Геттер.
	 *
	 *
	 **/
	public function GetResult()
	{
		return $this->arActionResult;
	}

	/**
	 * Функция выполняет всю работу фильтра и возвращает результат.
	 *
	 *@param bool $cache - использовать закэшированный результат (если он есть), или нет
	 **/
	public function Get($cache = false)
	{

		if (($this->strContent == self::EMPTY_RESOURCE) || (!$cache)) // ИИС ещё не прочитан
		{
			return $this->ReadResource()
						->DoFilter()
						->DoActions()
						->GetResult();
		}
		elseif ($this->arFilterResult === array(self::EMPTY_FILTER_RESULT)) // ИИС прочитан, но не отфильтрован
		{
			return $this->DoFilter()
						->DoActions()
						->GetResult();
		}
		elseif ($this->arActionResult === array(self::EMPTY_ACTION_RESULT)) // ИИС отфильтрован, но выборки не было
		{
			return $this->DoActions()
						->GetResult();
		}

		return $this->GetResult(); // всё уже готово, вызываем геттер
	}

	/**
	 * Функция получает данные от информационного источника и выводит их вместе с панелькой настроек.
	 *
	 *
	 **/
	public function GetPanel()
	{

		$success = 0;
		$strRes = self::ERROR_RESULT;

		if ($this->strContent == self::EMPTY_RESOURCE) // ИИС ещё не прочитан
		{
			$this->ReadResource();
		}

		switch ($this->resource_type)		// смотрим тип информационного источника
		{
			case self::HTTP_RESOURCE:			// страничка на http-сервере
			{
				$matches = array('</BODY>','</body>'); // ищем закрывающий тег body
				foreach ($matches as $match)
				{
					$arRes = explode($match,$this->strContent);

					if (count($arRes)>1)
					{
						$success = 1;

						$matches = array('</HEAD>','</head>'); // ищем закрывающий тег head
						foreach ($matches as $match)
						{
							$temp = explode($match,$arRes[0]);

							if (count($temp)>1)
							{
								$success = 2;
								$arRes[0] = $temp;
							}
						}

						if ($success) // нашли теги
						{
							$strRes = $this->InsertHttpPanel($arRes,$success); // вставляем перед ними код панельки
						}

						break;
					}
				}
			}
			default:
			{
				$strRes = $this->strContent;
			}
		}

		return $strRes;
	}

	/**
	 * Функция добавляет в код веб-страницы html- и js- код для панельки настройки фильтра.
	 *
	 * @param array $arRes - код страницы, разбитый на head и body, либо только body (если $mode == 1)
	 * @param integer $mode = 1 - добавить css стили прямо в код, 2 - добавить css стили в head
	 *
	 **/
	public function InsertHttpPanel($arRes,$mode)
	{
		$strJS = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> ';
		$strCSS =
'<style type="text/css">

	div.maws_static_filter_panel
	{
		background-color:#d0e4fe;
		width:95%;
	}

	div.maws_fixed_filter_panel
	{
		position:fixed;
		bottom: 3px;
	}

</style>';

		$strHTML =
'<div id="maws_filter_panel" class="maws_static_filter_panel">
 <span onclick="$(\'#maws_filter_panel\').toggleClass(\'maws_fixed_filter_panel\');"> Nyaaa! </span>
</div>';
		if ($mode == 2)
		{
			$arRes[0][0].= $strJS.$strCSS; // добавляем стили перед </head>

			$arRes[0][1].= $strHTML; // добавляем html-код перед </body>
			$arRes[0] = implode('',$arRes[0]);
		}
		else
		{
			$arRes[0].= $strJS.$strCSS; // добавляем стили перед </body>
			$arRes[0].= $strHTML; // добавляем html-код перед </body>
		}

		$strRes = implode('',$arRes);
		return $strRes;
	}


	/**
	 * Функция считывает веб-страничку и возвращает её содержимое.
	 **/
	public function ReadHttpResource()
	{

		// create curl resource
		$ch = curl_init();

		// составляем строку с параметрами запроса, наподобие file=ttt.txt&name=aaa.txt

		if (is_array(unserialize($this->resource_params)))
		{
			$strParams = http_build_query(unserialize($this->resource_params));
		}
		else
		{
			$strParams = '';
		}

		if (strlen($strParams)>0) // нужно отослать запрос с параметрами
		{
			if ($this->resource_method==self::METHOD_POST) // отсылаем POST-запрос
			{
				$strUrl = $this->resource_url;
				curl_setopt($ch, CURLOPT_POSTFIELDS, $strParams);
			}
			else // отсылаем GET-запрос
			{
				$strUrl = $this->resource_url.'?'.$strParams;
			}
		}
		else // запрос без параметров
		{
			$strUrl = $this->resource_url;
		}

		// set url
		curl_setopt($ch, CURLOPT_URL, $strUrl);

		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, self::MAX_TIMEOUT);

		if (ini_get('open_basedir')) // если open_basedir не позволяет редиректы
		{
			$redirects = 0;
			while ($redirects < self::MAX_REDIRECTS)
			{
				$old_redirects = $redirects;
				$strRes = $this->GetCurlRedirect($ch, $redirects);

				if ($old_redirects == $redirects)
				{
					break; // число редиректов не увеличилось - значит, функция GetCurlRedirect вернула контент
				}
				else
				{
					$strUrl = $strRes; // число редиректов увеличилось - значит, функция GetCurlRedirect вернула новый url, на который редиректимся
					if (strlen($strParams)>0) // нужно отослать запрос с параметрами
					{
						if (strtolower($this->resource_method)=='post') // отсылаем POST-запрос
						{
							// cUrl уже настроен, ничего не делаем с $strUrl
						}
						else // отсылаем GET-запрос
						{
							$strUrl = $strUrl.'?'.$strParams;
						}
					}
					else // запрос без параметров
					{
						// ничего не делаем с $strUrl
					}
					curl_setopt($ch, CURLOPT_URL, $strUrl); // в след. раз пойдём по перенаправленному url

				}
			}
		}
		else
		{
			//TRUE to follow any "Location: " header that the server sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set).
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_MAXREDIRS, self::MAX_REDIRECTS); // The maximum amount of HTTP redirections to follow

			$strRes = curl_exec($ch); // get content
		}

		// close curl resource to free up system resources
		curl_close($ch);

		return $strRes;
	}

	/**
	 * Функция считывает каталог ftp-сервера и возвращает его содержимое.
	 **/
	public function ReadFtpResource()
	{
		return '';
	}

	/**
	 * Функция считывает файл на http-сервере и возвращает его содержимое.
	 **/
	public function ReadHttpFileResource()
	{
		return '';
	}

	/**
	 * Функция считывает файл на ftp-сервере и возвращает его содержимое.
	 **/
	public function ReadFtpFileResource()
	{
		return '';
	}

	/**
	 * Функция вызывает другой фильтр и возвращает результат его работы.
	 **/
	public function ReadFilterResource()
	{
		return '';
	}

	/**
	 * Узнаёт, куда надо редиректиться cURL, вручную (если open_basedir не позволяет сделать это автоматически)
	 *
	 * Возвращает либо полученные данные, либо url, куда надо редиректиться (в ээтом случае $redirects++).
	 *
	 * @param resource $ch - cURL-ресурс
	 * @param integer $redirects - количество редиректов
	 *
	 **/
	function GetCurlRedirect($ch, &$redirects)
	{

		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($http_code == 301 || $http_code == 302)
		{
			$header = explode("\r\n\r\n", $data, 2);
			$matches = array('Location:','URI:');
			$url = '';
			foreach( $matches as $match)
			{
				$test = explode($match,$header[0]);
				if (count($test)>1)
				{
					$url = explode("\n",$test[1]);
					break;
				}
			}
			$url = trim($url[0]);
			$url_parsed = parse_url($url);
			if (isset($url_parsed))
			{
				$redirects++;
				return $url;
			}
			else return self::ERROR_RESULT;
		}
		else
		{
			list(,$body) = explode("\r\n\r\n", $data, 2);
			return $body;
		}
    }

} // MawsParser
