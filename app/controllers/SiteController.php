<?php

require 'app/core/Controller.php';
require 'app/models/Task.php';
require 'app/models/Validation.php';

/**
 * Class SiteController
 */
class SiteController extends Controller
{

    /**
     * Validation rules
     * @var array
     */
    protected $_rules = [
        'name'           =>'required',
        'email'         =>'required, email',
    ];

    /**
     *Validation messages
     * @var array
     */
    protected $_messages = [
        'name'           => [
            'required'=>'Field is required',
        ],
        'email'           => [
            'required'=>'Field is required',
            'email'      =>'Invalid  email',
        ],

    ];

    /**
     *Index action
     */
    public function index()
    {
        $perPage = 3;
        $page= (int)(isset($_GET['page'])  ? ($_GET['page']) : 1);
        $model = Task::findAllLimit($page, $perPage, ['status' => 'DESC']);
        $model['totalPages'] = ceil($model['totalRows'] / $perPage);
        $model['page'] = $page;

        $this->view->render('index', 'Номе', $model );
    }

    /**
     *Sort action
     */
    public function sort()
    {
        $perPage = 5;
        $sort=$_POST['sort'];
        $page= (int)(isset($_GET['page'])  ? ($_GET['page']) : 1);
        $model = Task::findAllLimit($page, $perPage, [$sort => 'ASC']);
        $model['totalPages'] = ceil($model['totalRows'] / $perPage);
        $model['page'] = $page;

        $this->view->render('index', 'Номе', $model );
    }

    /**
     *Create action
     */
    public function create()
    {
        if (!$_POST) {
            $this->view->render('create', 'Create');
        }
        else {
            $validator = new Validation($_POST, $this->_rules, $this->_messages);
            $validator->validate();
            if($validator->isValid()) {
                $text=(string)$_POST['text'];
                $text=htmlspecialchars($text);
                $model=new Task();
                $model->name = (string)$_POST['name'];
                $model->email = (string)$_POST['email'];
                $model->text = $text;
                $model->status = 0;
                if ($model->save())
                {
                    header('Location: /');
                }
            }
            else {
                $this->view->render('create', 'Create', $validator);
            }
        }
    }

    /**
     *Update action
     */
    public function update()
    {
        $id=$_POST['id'];
        $model=Task::find($id);
        $model->text = (string)$_POST['text'];
        $model->status = 1;
        if ($model->save())
        {
            header('Location: /');
        }
    }
    
    /**
     *Set done status action
     */
    public function setDoneStatus()
    {
        $id=$_POST['id'];
        $model=Task::find($id);
        $model->status = 2;
        if ($model->save())
        {
            header('Location: /');
        }
    }

    /**
     *View action
     */
    public function view()
    {
        $id=$_POST['id'];
        $model=Task::find($id);
        $this->view->render('view', "view->$id", $model);
    }
}