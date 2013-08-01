<ul id="myTab" class="nav nav-tabs two-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Основные параметры</a></li>

</ul>


<?
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'personal-form',
    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data',),
)); ?>



<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="tab1">
        <fieldset>

            <div class="row">
                <div class="param span4">
                    <?=$form->labelEx($model, 'name');?>
                    <?=$form->textField($model, 'name', array('maxlength' => 200));?>
                    <?=$form->error($model, 'name');?>
                </div>
                <div class="param span4">
                    <?=$form->labelEx($model, 'surname');?>
                    <?=$form->textField($model, 'surname', array('maxlength' => 200));?>
                    <?=$form->error($model, 'surname');?>
                </div>
                <div class="param span4">
                    <?=$form->labelEx($model, 'father_name');?>
                    <?=$form->textField($model, 'father_name', array('maxlength' => 200));?>
                    <?=$form->error($model, 'father_name');?>
                </div>
            </div>

            <div class="row">
                <div class="param span4">
                    <?=$form->labelEx($model, 'login');?>
                    <?=$form->textField($model, 'login', array('maxlength' => 200));?>
                    <?=$form->error($model, 'login');?>
                </div>
                <div class="param span4">
                    <?=$form->labelEx($model, 'password');?>
                    <?=$form->textField($model, 'password', array('maxlength' => 200));?>
                    <?=$form->error($model, 'password');?>
                </div>
            </div>

            <div class="row">
                <div class="param span4">
                    <?=$form->labelEx($model, 'email');?>
                    <?=$form->textField($model, 'email', array('maxlength' => 200));?>
                    <?=$form->error($model, 'email');?>
                </div>
                <div class="param span4">
                    <?=$form->labelEx($model, 'phone');?>
                    <?=$form->textField($model, 'phone', array('maxlength' => 200));?>
                    <?=$form->error($model, 'phone');?>
                </div>
            </div>

        </fieldset>
    </div>
    <div class="tab-pane fade" id="tab2">

    </div>
</div>


<div class="row row-submit">
    <input type="submit" class="btn btn-success" value="Сохранить">
</div>


<? $this->endWidget(); ?>