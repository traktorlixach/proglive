<?php//// Список всех статей//function articles_all() {	$result = mysql_query("SELECT * FROM `articles` ORDER BY `articles`.`create_date` DESC;");	if (!$result) return false;		// Извлечение из БД.	while ($row = mysql_fetch_array($result)) {        $row['content_intro'] = content_intro($row['content']);        $articles[] = $row;	}	return $articles;}//// Конкретная статья//function get_article($id_article) {    $sql = "SELECT * FROM `articles` JOIN `users` USING (`id_user`) WHERE `articles`.`id_article` = '%d';";    $sql = sprintf($sql, protect($id_article));    $article = mysql_fetch_array(mysql_query($sql));    if (!$article) return false;    return $article;}//// Добавить статью//function new_article($subject, $content) {	// Запрос.    $sql = "INSERT INTO `proglive_php2`.`articles` (    `id_article`,                                                        `subject`,                                                        `content`,                                                        `id_user`,                                                        `create_date`)                                            VALUES (    NULL,                                                        '%s',                                                        '%s',                                                        '1',                                                        '2032-01-01 23:59:59');";    $sql = sprintf($sql, protect($subject), protect($content));	$result = mysql_query($sql);	if (!$result) return false;    $_SESSION['add_success'] = true;	return true;}//// Изменить статью//function edit_article($id_article, $subject, $content) {    $sql = "UPDATE `proglive_php2`.`articles` SET   `subject` = '%s',                                                    `content` = '%s'                                            WHERE   `articles`.`id_article` = '%d';";    $sql = sprintf($sql, protect($subject), protect($content), protect($id_article));    $result = mysql_query($sql);    if (!$result) return false;    $_SESSION['update_success'] = true;    return true;}//// Удалить статью//function delete_article($id_article) {    $sql = "DELETE FROM `proglive_php2`.`articles` WHERE `articles`.`id_article` = '%d';";    $sql = sprintf($sql, protect($id_article));    $result = mysql_query($sql);    if (!$result) return false;    $_SESSION['delete_success'] = true;    return true;}//// Короткое описание статьи//function content_intro($article_content) {    if (mb_strlen($article_content) > MAX_SYMBOL_INTRO) {        $article_content = explode(' ', mb_substr($article_content, 0, MAX_SYMBOL_INTRO, ENCODING));        array_pop($article_content);        $article_content = implode(' ', $article_content) . '...';    }    return $article_content;}//// экранирует одинарные кавычки, html-теги и лишние пробелы по краям//function protect($str) {    return trim(htmlspecialchars(mysql_real_escape_string($str)));}//// передаёт в шаблон массив переменных, шаблон выполняется, вывод производится посредством буфера//function template($source_tpl, $vars = array()) {    extract($vars);    ob_start();    include("$source_tpl");    return ob_get_clean();}?>