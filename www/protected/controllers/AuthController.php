<?php

class AuthController extends Controller
{
    public $layout = 'guest';

    public function actionLogin()
    {

        if (Yii::app()->request->isAjaxRequest) {

            $response = array();

            $login = Yii::app()->request->getPost('login');
            $password = Yii::app()->request->getPost('password');

            $identity = new UserIdentity($login, $password);

            if ($identity->authenticate()) {

                Yii::app()->user->login($identity, 3600 * 24 * 30);

                $response = array(
                    'success' => 1,
                    'url' => '/',
                );
            }
            else{
                $response = array(
                    'success' => 0,
                    'error' => 'Неверный пароль',
                );
            }

            echo json_encode($response);
            Yii::app()->end();
        }

        $this->render('login');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/');
    }

}