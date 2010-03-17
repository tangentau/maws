<?php

/**
 * Skeleton subclass for representing a row from the 'maws_filter' table.
 *
 * Класс для получения отфильтрованного контента информационных источников (ИИС)
 *
 * Получает данные из ИИС различных типов ( $arResource )
 * Фильтрует полученные данные ( $strContent ) по заданным правилам фильтрации ( $arFilter )
 * Выполняет заданные действия над полученными отфильтрованными данными ( Actions )
 *
 * @package    lib.model
 *
 */


class MawsFilter extends BaseMawsFilter {


/************************************** КОНСТАНТЫ КЛАССА *******************************/

/*** типы ИИС: ***/

	const	HTTP_RESOURCE		= 7001;		// страница HTTP-сервера
	const	FTP_RESOURCE		= 7002;		// каталог FTP-сервера
	const	HTTP_FILE_RESOURCE	= 7003;		// файл на HTTP-сервере
	const	FTP_FILE_RESOURCE	= 7004;		// файл на FTP-сервере
	const	FILTER_RESOURCE		= 7005;		// другой фильтр

/*** типы фильтров данных, полученных от ИИС: ***/

	const	REGEXP_FILTER		= 8001;		// старые добрые регулярки
	const	DOM_FILTER			= 8002;		// фильтр DOM-cтруктуры HTML-документа
	const	CSS_FILTER			= 8003;		// ?

/*** типы действий над отфильтрованными данными (arFilterResult): ***/

	const	GET_ALL				= 9001;		// взять все результаты фильтрации
	const	GET_FIRST_N			= 9002;		// взять первые N результатов фильтрации
	const	GET_LAST_N			= 9003;		// взять последние N результатов фильтрации
	const	GET_COUNT			= 9004;		// взять количество результатов фильтрации
	const	GET_RANDOM			= 9005;		// взять рандомный результат фильтрации (один или несколько)
	const	GET_MNTH			= 9006;		// взять N-ный результат фильтрации и M результатов после него

/*** прочие константы ****/

	const	ERROR_RESULT		= -1;		// значение ошибки по умолчанию
	const	EMPTY_RESOURCE		= -1025;	// значение неинициализированного ИИС
	const	EMPTY_FILTER_RESULT	= -1026;	// значение неинициализированного результата фильтра
	const	EMPTY_ACTION_RESULT	= -1027;	// значение неинициализированной выборки (результата действий)

	const	MAX_REDIRECTS		= 5;		// макс. число редиректов cURL

	const	MAX_TIMEOUT			= 3;		// макс. время таймаута cURL

/************************************** РАБОЧИЕ ПЕРЕМЕННЫЕ КЛАССА *******************************/


/*** используемый ИИС: ***/

	protected	$resource_type = self::HTTP_RESOURCE;			// тип ИИС
	protected	$resource = 'http://www.example.com';
	protected	$resource_method = 'GET';						// как обращаться к HTTP_RESOURCE
	protected	$resource_params = array();						// для HTTP_RESOURCE
	protected	$resource_login = '';
	protected	$resource_password = '';
									

/*** данные, полученных от ИИС: ***/

	protected $strContent 	= self::EMPTY_RESOURCE;

/*** фильтр данных, полученных от ИИС: ***/
	protected	$filter_type = self::REGEXP_FILTER;				// тип фильтра
	protected	$filter_string = '';							// собственно фильтр


/*** результат фильтрации ***/

	protected $arFilterResult = array(self::EMPTY_FILTER_RESULT);

/*** действия над отфильтрованными данными ***/
	protected	$action_type = self::GET_MNTH;					// тип действий
	protected	$action_param1 = 2;								// первый параметр
	protected	$action_param2 = 2;								// первый параметр
	protected	$action_param3 = 2;								// первый параметр

/*** результат работы класса ***/

	protected $arActionResult	= array(self::EMPTY_ACTION_RESULT);


	public $debug = array();

/************************************** МЕТОДЫ КЛАССА *******************************/

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
		}

		// $this->strContent contains the output string
		$this->strContent = $strRes;

		return $this;
	}

	/**
	 * Фильтрует полученный контент ИИС.
	 * ИИС может быть веб-страничкой, каталогом ftp-сервера, файлом или фильтром,
	 * а фильтр может быть регекспом, DOM- или CSS- шаблоном.
	 *
	 **/
	public function DoFilter()
	{
		$this->arFilterResult = array($this->strContent);
		return $this;
	}

	/**
	 * Отбирает полученные результаты фильтрации контента ИИС.
	 * Берёт все результаты, или несколько первых, или возвращает количество результатов и т.д.
	 *
	 **/
	public function DoActions()
	{
		$this->arResult = $this->arFilterResult;
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
	 *
	 **/
	public function Get()
	{
		if ($this->strContent == self::EMPTY_RESOURCE) // ИИС ещё не прочитан
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
		$this->debug[] = '-----------';

		// create curl resource
		$ch = curl_init();

		// составляем строку с параметрами запроса, наподобие file=ttt.txt&name=aaa.txt
		$strParams = http_build_query($this->resource_params);

		if (strlen($strParams)>0) // нужно отослать запрос с параметрами
		{
			if (strtolower($this->resource_method)=='post') // отсылаем POST-запрос
			{
				$strUrl = $this->resource;
				curl_setopt($ch, CURLOPT_POSTFIELDS, $strParams);
			}
			else // отсылаем GET-запрос
			{
				$strUrl = $this->resource.'?'.$strParams;
			}
		}
		else // запрос без параметров
		{
			$strUrl = $this->resource;
		}
		echo($strUrl);
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


} // MawsFilter
