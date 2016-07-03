<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 12:24
 */
class RegistrationController extends Controller
{
    public function compile($parameters)
    {
        $this->head['title'] = 'Registrace';
        if ($_POST)
        {
            try
            {
                $usersManager = new UsersManager();
                $usersManager->register($_POST['name'], $_POST['password'], $_POST['passwordAgain'], $_POST['year']);
                $usersManager->login($_POST['name'], $_POST['password']);
                $this->addMessage('Byl jste úspěšně zaregistrován.');
                $this->redirect('administration');
            }
            catch (UserError $error)
            {
                $this->addMessage($error->getMessage());
            }
        }
        $this->view = 'registration';
    }
}