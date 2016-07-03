<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 09:56
 */
class ArticlesManager
{
    public function returnArticle($url)
    {
        return Db::queryOne('
                        SELECT `articles_id`, `title`, `content`, `url`, `description`, `keywords`
                        FROM `articles`
                        WHERE `url` = ?
                ', array($url));
    }

    public function returnArticles()
    {
        return Db::queryAll('
                        SELECT `articles_id`, `title`, `url`, `description`
                        FROM `articles`
                        ORDER BY `articles_id` DESC
                ');
    }

    public function saveArticle($id, $article)
    {
        if (!$id)
            Db::insert('articles', $article);
        else
            Db::change('articles', $article, 'WHERE articles_id = ?', array($id));
    }

    public function removeArticle($url)
    {
        Db::query('
                DELETE FROM articles
                WHERE url = ?
        ', array($url));
    }
}