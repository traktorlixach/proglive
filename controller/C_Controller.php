<?php//// Базовый класс контроллера.//abstract class C_Controller {    public function __construct() {        // подключаем конфиги        require_once('/config.php');        // играем с кодировкой        mb_internal_encoding(ENCODING);                                                                                             // установка внутренней кодировки скрипта        setlocale(LC_ALL, 'ru_RU.' . ENCODING);                                                                                     // кодировка исполнения php        session_start();                                                                                                            // старт сессии    }	// Генерация внешнего шаблона	protected abstract function render();		// Функция отрабатывающая до основного метода	protected abstract function before();		public function Request($action) {		$this->before();		$this->$action();		$this->render();	}		//	// Запрос произведен методом GET?	//	protected function IsGet() {		return $_SERVER['REQUEST_METHOD'] == 'GET';	}	//	// Запрос произведен методом POST?	//	protected function IsPost() {		return $_SERVER['REQUEST_METHOD'] == 'POST';	}	//	// передаёт в шаблон массив переменных, шаблон выполняется, вывод производится посредством буфера	//    function Template($source_tpl, $vars = array()) {        extract($vars);        ob_start();        include("$source_tpl");        return ob_get_clean();    }    // Если вызвали метод, которого нет - завершаем работу	public function __call($name, $params) {        die('Не пишите фигню в url-адресе!!!');	}}?>