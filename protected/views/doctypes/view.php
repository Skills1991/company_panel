<?php
/* @var $this DoctypesController */
/* @var $model Doctypes */

$this->breadcrumbs=array(
	'Doctypes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Doctypes', 'url'=>array('index')),
	array('label'=>'Create Doctypes', 'url'=>array('create')),
	array('label'=>'Update Doctypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Doctypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Doctypes', 'url'=>array('admin')),
);
?>

<h1>View Doctypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
