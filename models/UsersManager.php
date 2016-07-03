<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 12:13
 */
class UsersManager
{
    public function returnImprint($password)
    {
        $salt = 'fd16sdfd2ew#$%';
        return hash('sha256', $password . $salt);
    }

    public function register($name, $password, $passwordAgain, $year)
    {
        if ($year != date('Y'))
            throw new UserError('Chybně vyplněný antispam.');
        if ($password != $passwordAgain)
            throw new UserError('Hesla nesouhlasí.');
        $user = array(
            'name' => $name,
            'password' => $this->returnImprint($password),
        );
        try
        {
            Db::insert('users', $user);
        }
        catch (PDOException $error)
        {
            throw new UserError('Uživatel s tímto jménem je již zaregistrovaný.');
        }
    }

    public function login($name, $password)
    {
        $user = Db::queryOne('
                        SELECT users_id, name, admin
                        FROM users
                        WHERE name = ? AND password = ?
                ', array($name, $this->returnImprint($password)));
        if (!$user)
            throw new UserError('Neplatné jméno nebo heslo.');
        $_SESSION['user'] = $user;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function returnUser()
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }

}