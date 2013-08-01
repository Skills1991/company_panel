<?php
/* @var $this DoctypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctypes',
);

$this->menu=array(
	array('label'=>'Create Doctypes', 'url'=>array('create')),
	array('label'=>'Manage Doctypes', 'url'=>array('admin')),
);
?>

<h1>Doctypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
