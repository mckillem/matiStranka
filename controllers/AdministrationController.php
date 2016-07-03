<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 13:42
 */
class AdministrationController extends Controller
{
    public function compile($parameters)
    {
        $this->verifyUser();
        $this->head['title'] = 'Přihlášení';
        $usersManager = new UsersManager();
        if (!empty($parameters[0]) && $parameters[0] == 'logout')
        {
            $usersManager->logout();
            $this->redirect('login');
        }
        $user = $usersManager->returnUser();
        $this->data['name'] = $user['name'];
        $this->data['admin'] = $user['admin'];
        $this->view = 'administration';
    }
}
