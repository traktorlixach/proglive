<?php//// вспомогательные функции//class M_Functions {    private static $instance;    public static function Instance() {        if (self::$instance == null) self::$instance = new self;        return self::$instance;    }    //    // Конструктор    //    private function __construct() {    }    //    // Короткое описание статьи    //    public function content_intro($content) {        if (mb_strlen($content) > MAX_SYMBOL_INTRO) {            $intro = explode(' ', mb_substr($content, 0, MAX_SYMBOL_INTRO, ENCODING));            array_pop($intro);            $intro = implode(' ', $intro) . '...';        }        else $intro = $content;        return $intro;    }    //    // экранирует одинарные кавычки, html-теги и лишние пробелы по краям    //    public function protect($str) {        return trim(htmlspecialchars(mysql_real_escape_string($str)));    }}?>