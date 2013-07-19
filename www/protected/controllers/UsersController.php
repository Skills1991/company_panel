<?php

class UsersController extends Controller
{
    public $active_page = 'users';

    public function actionIndex()
    {
        $this->render('index');
    }


}