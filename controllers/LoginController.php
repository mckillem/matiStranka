<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 13:48
 */
class LoginController extends Controller
{
    public function compile($parameters)
    {
        $usersManager = new UsersManager();
        if ($usersManager->returnUser())
            $this->redirect('administration');
        $this->head['titulek'] = 'Přihlášení';
        if ($_POST)
        {
            try
            {
                $usersManager->login($_POST['name'], $_POST['password']);
                $this->addMessage('Byl jste úspěšně přihlášen.');
                $this->redirect('administration');
            }
            catch (UserError $error)
            {
                $this->addMessage($error->getMessage());
            }
        }
        $this->view = 'login';
    }
}