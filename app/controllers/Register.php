<?php

class Register extends Controller {

    public function __construct($controller, $action){
        parent::__construct($controller,$action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction() {
        // echo password_hash('password', PASSWORD_DEFAULT);
        $validation = new Validate();
        if($_POST) {
            //from valisation
            $validation->check($_POST,[
                'username' =>[
                    'display' => "Username",
                    'required' => true
                ],
                'password' => [
                    'display' => 'password',
                    'required' => true,
                    'min' => 6
                ]
            ]);
            if($validation->passed()) {
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if($user && password_verify(Input::get('password'), $user->password)) {
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true :false;
                    $user->login($remember);
                    Router::redirect('');
                } else {
                    $validation->addError("There is an error with your uesrname or password");
                }
            } 
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/login');
    }

    public function logoutAction() {
        if(currentUser()) {
            currentUser()->logout();
        }
        Router::redirect('register/login');
    }
}