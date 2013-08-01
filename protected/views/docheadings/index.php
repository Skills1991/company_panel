<?php
/* @var $this DocheadingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Docheadings',
);

$this->menu=array(
	array('label'=>'Create Docheadings', 'url'=>array('create')),
	array('label'=>'Manage Docheadings', 'url'=>array('admin')),
);
?>

<h1>Docheadings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
