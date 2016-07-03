<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 12:00
 */
class EditorController extends Controller
{
    public function compile($parameters)
    {
        $this->verifyUser(true);
        $this->head['title'] = 'Editor článků';
        $articlesManager = new ArticlesManager();
        $article = array(
            'articles_id' => '',
            'title' => '',
            'content' => '',
            'url' => '',
            'description' => '',
            'keywords' => '',
        );
        if ($_POST)
        {
            $keys = array('title', 'content', 'url', 'description', 'keywords');
            $article = array_intersect_key($_POST, array_flip($keys));
            $articlesManager->saveArticle($_POST['articles_id'], $article);
            $this->addMessage('Článek byl úspěšně uložen.');
            $this->redirect('article/' . $article['url']);
        }
        else if (!empty($parameters[0]))
        {
            $loadedArticle = $articlesManager->returnArticle($parameters[0]);
            if ($loadedArticle)
                $article = $loadedArticle;
            else
                $this->addMessage('Článek nebyl nalezen');
        }

        $this->data['article'] = $article;
        $this->view = 'editor';
    }
}