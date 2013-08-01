<?php
/* @var $this DoctypesController */
/* @var $model Doctypes */

$this->breadcrumbs=array(
	'Doctypes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Doctypes', 'url'=>array('index')),
	array('label'=>'Create Doctypes', 'url'=>array('create')),
	array('label'=>'View Doctypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Doctypes', 'url'=>array('admin')),
);
?>

<h1>Update Doctypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>