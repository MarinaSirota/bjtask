<?php

require 'app/core/Controller.php';
require 'app/models/Validation.php';
require_once 'app/models/User.php';

/**
 * Class SignInController
 */
class SignInController extends Controller
{
    /**
     * Validation rules
     * @var array
     */
    protected $_rules    = [
        'email'         =>'required',
        'password'           =>'required',
    ];

    /**
     *Validation messages
     * @var array
     */
    protected $_messages = [

        'password'           => [
            'required'=>'Field is required',
        ],
        'email'           => [
            'required'=>'Field is required',
        ],
    ];

    /**
     *Index action
     */
    public function index()
    {
        $this->view->render('signIn', 'signIn');
    }

    /**
     *Action on Sign In
     */
    public function submit()
    {
        $validator = new Validation($_POST, $this->_rules, $this->_messages);
        $validator->validate();
        if($validator->isValid()) {
            if($this->validateUser()) {
                header('Location: /');
            } else {
                $validator->addError('login_error', 'Логин или пароль не правильные');

            }
        }
        $this->view->render('signIn', 'signIn', $validator);
    }

    /**
     *Logout action
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    /**
     * @return bool
     */
    public function validateUser()
    {
        $user=new User();
        $users = $user->findAll(['email' => $_POST['email']]);
        if(count($users) > 0) {
            $foundUser = $users[0];
            if($foundUser->password === md5($_POST['password'])) {
                $_SESSION['email'] = $foundUser->email;
                $_SESSION['isLoggedIn'] = true;
                if($foundUser->email == 'admin')
                {
                    $_SESSION['isAdmin'] = true;
                }
                return true;
            }

        }
        return false;
    }

}