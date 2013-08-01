<?php

class DocumentsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
    public $active_page = 'documents';

    public function actionGetFiles()
    {

    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionOtkat($id)
	{

        $criteria = new CDbCriteria(array('order'=>'id DESC', 'condition'=>'family='.$this->loadModel($id)->family.' AND id>'.$id));
        $docs = Documents::model()->findAll($criteria);
        foreach($docs as $doc)
        {
            @unlink($doc->link);
            $doc->delete();
        }
        $this->redirect(array('index'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Documents;

		// Uncomment the following line if AJAX validation is needed
	    $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
            $lastId = Documents::model()->find(new CDbCriteria(array('order'=>'id DESC','limit'=>1)));
            if ($lastId != NULL)
			    $lastId = $lastId->id++;
            else
                $lastId=1;
            $model->attributes=$_POST['Documents'];
            $doc = CUploadedFile::getInstance($model, 'link');
            $model->user_id = Yii::app()->user->id;
            $model->family = $lastId;
            if ($doc != NULL)
                $model->link = "uploads/documents/".$lastId."/".$lastId.'_'.str_replace(" ","_",$doc->name);
            if ($model->dostup != NULL)
            $model->dostup = implode(';',$model->dostup);
            $model->date = date("d.m.Y H:i:s");
			if($model->save())
            {
                @mkdir('uploads/documents/'. $model->id, 0777);
                @$doc->saveAs($model->link);
				$this->redirect(array('index'));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
            $newDoc = new Documents;
            $lastId = Documents::model()->find(new CDbCriteria(array('order'=>'id DESC','limit'=>1)));
            if ($lastId != NULL)
                $lastId = $lastId->id++;
            $newDoc->attributes=$_POST['Documents'];
            $newDoc->user_id = Yii::app()->user->id;
            $newDoc->family = $model->family;
            $doc = CUploadedFile::getInstance($model, 'link');
            if ($doc != NULL)
                $newDoc->link = "uploads/documents/".$newDoc->family."/".($lastId).'_'.str_replace(" ","_",$doc->name);
            if ($newDoc->dostup != NULL)
                $newDoc->dostup = implode(';',$newDoc->dostup);
            $newDoc->date = date("d.m.Y H:i:s");
            if($newDoc->save())
            {
                //@mkdir('uploads/documents/'. $model->id, 0777);
                @$doc->saveAs($newDoc->link);
                $this->redirect(array('index'));
            }
		}
        $criteria = new CDbCriteria(array('order'=>'id DESC', 'condition'=>'family='.$model->family.'  AND id!='.$id));
        $olderDocs = Documents::model()->findAll($criteria);
		$this->render('update',array(
			'model'=>$model,
			'olderDocs'=>$olderDocs,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        if (Yii::app()->request->isAjaxRequest) {
            $output = false;
            $used = array();
            $userJob = Job::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
            $departments = Yii::app()->request->getPost('departments');
            $types = Yii::app()->request->getPost('types');
            $docs = array();
            $criteria = new CDbCriteria(array('order'=>'id DESC'));
            foreach($types as $type)
                $criteria->addCondition('type_id='.$type,'OR');
            $docs = Documents::model()->findAll($criteria);
            $already = array();
            if (isset($departments[0]))
            {
                foreach ($departments as $department)
                {
                    foreach($docs as $doc)
                    {
                        if ($doc->hasDepartment($department) && !in_array($doc->id,$already) && !in_array($doc->family,$used))
                        {
                            $output = true;
                            $used[] = $doc->family;
                            $url = Yii::app()->baseUrl.DIRECTORY_SEPARATOR.$doc->link;
echo <<<DOC
    <tr>
    <td>{$doc->type->name}</td>
    <td>{$doc->name}</td>
    <td>{$doc->date}</td>
    <td>
    <span class="userInfo" id="{$doc->user->id}">{$userJob->name} {$doc->user->surname} {$doc->user->name} {$doc->user->father_name}</span><br>
    <div class="userInfoView">
        <p><strong>E-mail:</strong> {$doc->user->email}</p>
        <p><strong>Телефон:</strong> {$doc->user->phone}</p>
    </div>
    </td>
    <td class="actions">
        <a href="/personal/edit/>" class="btn btn-mini btn-success">Заменить</a>
        <a href="{$url}" class="btn btn-mini btn-success">Скачать</a>
    </td>
    <td>{$doc->user->name}</td>
    </tr>
DOC;
                            $already[] = $doc->id;
                        }
                    }
                }
            }
            else
                foreach($docs as $doc)
                {
                    if (!in_array($doc->family,$used))
                    {
                    $used[] = $doc->family;
                    $output = true;
                    $url = Yii::app()->baseUrl.DIRECTORY_SEPARATOR.$doc->link;
echo <<<DOC
    <tr>
    <td>{$doc->type->name}</td>
    <td>{$doc->name}</td>
    <td>{$doc->date}</td>
    <td>
    <span class="userInfo" id="{$doc->user->id}">{$userJob->name} {$doc->user->surname} {$doc->user->name} {$doc->user->father_name}</span><br>
    <div class="userInfoView">
        <p><strong>E-mail:</strong> {$doc->user->email}</p>
        <p><strong>Телефон:</strong> {$doc->user->phone}</p>
    </div>
    </td>
    <td class="actions">
        <a href="/personal/edit/>" class="btn btn-mini btn-success">Заменить</a>
        <a href="{$url}" class="btn btn-mini btn-success">Скачать</a>
    </td>
    <td>{$doc->user->name}</td>
    </tr>
DOC;
                }
            }
            if (!$output)
                echo <<<h
<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
h;
            Yii::app()->end();
        }
        $used = array();
        $userJob = Job::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
        $model = Documents::model()->findAll(new CDbCriteria(array('order'=>'id DESC')));
        $this->render('index',array('model'=>$model, 'userJob'=>$userJob));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Documents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documents']))
			$model->attributes=$_GET['Documents'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documents the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documents $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
