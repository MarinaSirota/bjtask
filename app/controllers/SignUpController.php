<?php

require 'app/core/Controller.php';
require 'app/models/Validation.php';
require 'app/models/User.php';

/**
 * Class signUpController
 */
class signUpController extends Controller
{
    /**
     * @var array
     */
    protected $_rules    = [
        'email'         =>'required,email',
        'password'           =>'required',
    ];

    /**
     * @var array
     */
    protected $_messages = [

        'email'           => [
            'required'=>'Поле обязательное',
            'email'      =>'Должно быть существующим email',
        ],
        'password'           => [
            'required'=>'Поле обязательное',
        ],
    ];

    /**
     * Index Action
     */
    public function index()
    {
        $this->view->render('signUp', 'signUp' );
    }

    public function submit()
    {
        $validator = new Validation($_POST, $this->_rules, $this->_messages);
        $validator->validate();

        if($validator->isValid()) {
            if($this->checkEmail()){
                $this->createUser();
                $this->view->render('signIn', 'signIn');
            }
           else {
               $validator->addError('login_used', 'Email is already registered.');
               
               $this->view->render('signUp', 'signUp', $validator);
           }
        } else {
            $this->view->render('signUp', 'signUp', $validator);
        }

    }

    public function createUser()
    {
        $user=new User();
        $user->email=$_POST['email'];
        $user->password=md5($_POST['password']);
        $user->save();

    }

    public function checkEmail()
    {
        $user=new User();
        $users = $user->findAll(['email' => $_POST['email']]);
        if(count($users) > 0) {
            return false;
        }
        return true;
    }

    public function ajaxCheckEmail()
    {
        $data = [];
        if($this->checkEmail()) {
            $data['success'] = true;
        } else {
            $data = [
                'success' => false,
                'error' => 'Такой логин уже есть'
            ];
        }
        echo json_encode($data);

    }
}