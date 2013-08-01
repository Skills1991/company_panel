<?php
/* @var $this DocheadingsController */
/* @var $model Docheadings */

$this->breadcrumbs=array(
	'Docheadings'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Docheadings', 'url'=>array('index')),
	array('label'=>'Create Docheadings', 'url'=>array('create')),
	array('label'=>'Update Docheadings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Docheadings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Docheadings', 'url'=>array('admin')),
);
?>

<h1>View Docheadings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
