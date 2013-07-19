<?
$form = $this->beginWidget('CActiveForm', array(
    'action' => $model->isNewRecord ? '/jobs/create?head='.$model->head_type : '/jobs/edit/' . $model->id,
    'id' => 'job_form',
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

    <fieldset>

        <? if ($model->head_type == 0): ?>
            <div class="row">
                <?=$form->labelEx($model, 'department_id');?>
                <?=$form->dropDownList($model, 'department_id', Department::GetDropDownData($model->department_id));?>
                <span class="errorMessage error-Job_department_id"></span>
            </div>
        <? endif; ?>

        <div class="row">
            <?=$form->labelEx($model, 'user_id');?>
            <?=$form->dropDownList($model, 'user_id', User::GetAll(), array('empty' => 'Нет сотрудника'));?>
            <span class="errorMessage error-Job_user_id"></span>
        </div>

        <div class="row">
            <?=$form->labelEx($model, 'name');?>
            <?=$form->textField($model, 'name', array('maxlength' => 200));?>
            <span class="errorMessage error-Job_name"></span>
        </div>

        <div class="row">
            <?=$form->labelEx($model, 'functions');?>
            <?=$form->textarea($model, 'functions');?>
            <span class="errorMessage error-Job_functions"></span>
        </div>

        <div class="row">
            <?=$form->labelEx($model, 'result');?>
            <?=$form->textarea($model, 'result');?>
            <span class="errorMessage error-Job_result"></span>
        </div>

    </fieldset>

    <div class="row row-submit">
        <input type="submit" value="<?= $model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>">
    </div>

<? $this->endWidget(); ?>