<?php//// Список всех статей//function articles_all() {	$result = mysql_query("SELECT * FROM `articles` ORDER BY `articles`.`create_date` DESC;");	if (!$result) return false;		// Извлечение из БД.	while ($row = mysql_fetch_array($result)) {        $articles[] = $row;	}	return $articles;}//// Конкретная статья//function get_article($id_article){    $sql = "SELECT * FROM `articles` JOIN `users` USING (`id_user`) WHERE `articles`.`id_article` = '%d';";    $sql = sprintf($sql, protect($id_article));    $article = mysql_fetch_array(mysql_query($sql));    if (!$article) return false;    return $article;}//// Добавить статью//function articles_new($title, $content) {	// Запрос.    $sql = "INSERT INTO `proglive_php2`.`articles` (    `id_article`,                                                        `subject`,                                                        `context`,                                                        `id_user`,                                                        `create_date`)                                            VALUES (    NULL,                                                        '%s',                                                        '%s',                                                        '1',                                                        '2032-01-01 23:59:59');";    $sql = sprintf($sql, protect($title), protect($content));	$result = mysql_query($sql);	if (!$result) return false;    $_SESSION['add_success'] = true;	return true;}//// Изменить статью//function articles_edit($id_article, $title, $content){	// TODO}//// Удалить статью//function articles_delete($id_article){	// TODO}//// Короткое описание статьи//function articles_intro($article){	// TODO	// $article - это ассоциативный массив, представляющий статью}//// экранирует одинарные кавычки, html-теги и лишние пробелы по краям//function protect($str) {    return trim(htmlspecialchars(mysql_real_escape_string($str)));}