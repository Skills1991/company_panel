<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->redirect('/organization');
        $this->render('index');
    }


}