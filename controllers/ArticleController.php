<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 10:02
 */
class ArticleController extends Controller
{
    public function compile($parameters)
    {
        $articlesManager = new ArticlesManager();
        $usersManager = new UsersManager();
        $user = $usersManager->returnUser();
        $this->data['admin'] = $user && $user['admin'];

        if (!empty($parameters[1]) && $parameters[1] == 'remove')
        {
            $this->verifyUser(true);
            $articlesManager->removeArticle($parameters[0]);
            $this->addMessage('Článek byl úspěšně odstraněn');
            $this->redirect('article');
        }

        elseif (!empty($parameters[0]))
        {

            $article = $articlesManager->returnArticle($parameters[0]);
            if (!$article)
                $this->redirect('error');

            $this->head = array(
                'title' => $article['title'],
                'keywords' => $article['keywords'],
                'description' => $article['description'],
            );

            $this->data['title'] = $article['title'];
            $this->data['content'] = $article['content'];

            $this->view = 'article';
        }
        else
        {
            $articles = $articlesManager->returnArticles();
            $this->data['articles'] = $articles;
            $this->view = 'articles';
        }
    }
}