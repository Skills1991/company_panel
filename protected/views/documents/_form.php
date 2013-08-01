<?php $form=$this->beginWidget('CActiveForm', array(
    'action' => $model->isNewRecord ? '/documents/create' : '/documents/update/'.$model->id,
	'id'=>'documents-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'htmlOptions' => array('enctype' => 'multipart/form-data',),
)); ?>
<?php echo $form->errorSummary($model); ?>

        <fieldset>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
    </div>

    <!--<div class="row">
		<?php //echo $form->labelEx($model,'heading_id'); ?>
		<?php //echo $form->dropDownList($model,'heading_id',Docheadings::getHeadingsArray(), array('empty'=>'')); ?>
		<?php //echo $form->error($model,'heading_id'); ?>
    </div>-->

    <div class="row">
            <?php echo $form->labelEx($model,'type_id'); ?>
            <?php echo $form->dropDownList($model,'type_id', Doctypes::getTypesArray(), array('empty'=>'')); ?>
            <?php echo $form->error($model,'type_id'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'dostup'); ?>
		<?php echo $form->checkBoxList($model, 'dostup', Department::render_level_list_array(),
            array( 'separator'=>'<br>',
                'labelOptions'=> array('style' => 'display: inline')
            ));  ?>
		<?php echo $form->error($model,'dostup'); ?>
    </div>

    <div class="row">
        <p>Загрузка файла обязательна при любом редактировании!</p>
            <?php echo $form->labelEx($model,'link'); ?>
            <?php echo $form->fileField($model,'link'); ?>
            <?php echo $form->error($model,'link'); ?>
	</div>

    <div class="row">
            <?php echo $form->labelEx($model,'comment'); ?>
            <?php echo $form->textarea($model,'comment'); ?>
            <?php echo $form->error($model,'comment'); ?>
	</div>
        </fieldset>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Загрузить' : 'Изменить', array('class'=>'btn btn-success')); ?>
	</div>


<?php $this->endWidget(); ?>

