<?php
/* @var $this DocheadingsController */
/* @var $model Docheadings */

$this->breadcrumbs=array(
	'Docheadings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Docheadings', 'url'=>array('index')),
	array('label'=>'Create Docheadings', 'url'=>array('create')),
	array('label'=>'View Docheadings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Docheadings', 'url'=>array('admin')),
);
?>

<h1>Update Docheadings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>