<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 07:21
 */
abstract class Controller
{
    protected $data = array();
    protected $view = "";
    protected $head = array('title' => '', 'keywords' => '', 'description' => '');


    public function extractView()
    {
        if ($this->view) {
            extract($this->treat($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view . ".phtml");
        }
    }

    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

 

    abstract function compile($parameters);

    private function treat($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->treat($v);
            }
            return $x;
        }
        else
            return $x;
    }

    public function addMessage($message)
    {
        if (isset($_SESSION['messages']))
            $_SESSION['messages'][] = $message;
        else
            $_SESSION['messages'] = array($message);
    }

    public static function returnMessages()
    {
        if (isset($_SESSION['messages']))
        {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        }
        else
            return array();
    }

    public function verifyUser($admin = false)
    {
        $usersManager = new UsersManager();
        $user = $usersManager->returnUser();
        if (!$user || ($admin && !$user['admin']))
        {
            $this->addMessage('Nedostatečná oprávnění.');
            $this->redirect('login');
        }
    }
}