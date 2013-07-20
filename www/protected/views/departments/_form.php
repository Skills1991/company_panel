<?
$form = $this->beginWidget('CActiveForm', array(
    'action' => $model->isNewRecord ? '/departments/create' : '/departments/edit/'.$model->id,
    'id' => 'department_form',
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

    <fieldset>
        <? if($need_department_select): ?>
        <div class="row">
            <?=$form->labelEx($model, 'parent_id');?>
            <?=$form->dropDownList($model, 'parent_id', Department::GetDropDownData($default_root_id, $model->id));?>
            <span class="errorMessage error-Department_parent_id"></span>
        </div>
        <? endif; ?>
        <div class="row">
            <?=$form->labelEx($model, 'name');?>
            <?=$form->textField($model, 'name', array('maxlength' => 200));?>
            <span class="errorMessage error-Department_name"></span>
        </div>
        <div class="row">
            <?=$form->labelEx($model, 'functions');?>
            <?=$form->textarea($model, 'functions');?>
            <span class="errorMessage error-Department_functions"></span>
        </div>
        <div class="row">
            <?=$form->labelEx($model, 'result');?>
            <?=$form->textarea($model, 'result');?>
            <span class="errorMessage error-Department_result"></span>
        </div>
        <? if($model->isNewRecord && $model->parent_id == 0): ?>
        <div class="row">
            <?=$form->labelEx($model, 'head_id');?>
            <?=$form->dropDownList($model, 'head_id', User::GetAll(), array('empty' => 'Нет руководителя'));?>
            <span class="errorMessage error-Department_head_id"></span>
        </div>
    <? endif; ?>
    </fieldset>

    <div class="row row-submit">
        <input type="submit" value="<?=$model->isNewRecord ? 'Добавить' : 'Сохранить';?>">
    </div>

<? $this->endWidget(); ?>