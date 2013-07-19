<div id="page_department">

    <div class="buttons">
        <a href="#" data-action="/departments/create/?root=<?= $model->id ?>" data-header="Новое подразделение"
           class="btn btn-popup btn-success btn-add-department">Добавить подразделение</a>
        <a href="#" data-action="/jobs/create/?root=<?= $model->id ?>" data-header="Новая должность"
           class="btn btn-popup btn-success btn-add-job">Добавить должность</a>
    </div>

    <? if (empty($model->jobs) && empty($model->children)): ?>
        <div class="empty-block">
            <p>В данном отделе пусто</p>
        </div>
    <? else: ?>


        <? function rec_print($_this, $item, $level = 1, $prefix = '', $num = 1)
        {
            if ($level > 1)
                echo '<li class="department-item" data-id="' . $item['model']->id . '">
                <div class="department-header">
                    <span class="department-name">' . substr((empty($prefix) ? '' : $prefix . '.') . $num . '. ', 2) . $item['model']->name . '</span>
                    <a href="#" class="icon-edit btn-popup" data-action="/departments/edit/' . $item['model']->id . '" data-header="' . $item['model']->name . '"></a>
                    <a href="#" class="icon-remove"></a>
                </div>
            <ul>';



            foreach ($item['children'] as $ind => $child) {
                rec_print($_this, $child, $level + 1, (empty($prefix) ? '' : $prefix.'.').$num, $ind + 1);
            }

            foreach (Job::model()->findAllByAttributes(array('department_id' => $item['model']->id)) as $job) {
                $_this->renderPartial('//organization//_person_item', array('job' => $job));
            }

            echo '</ul></li>';
        }

        ?>

        <ul>
            <? rec_print($this, Department::GetTree($model->id)); ?>
        </ul>

    <? endif; ?>


    <div class="footer">
        C помощью этого блока, Вы можете справедливо распределить работу между сотрудниками, обозначить правильную
        подчиненность и избежать ситуации, когда один человек бегает то к началу «конвейера» бизнеса то в конец, пытаясь
        везде успеть и произвести продукт.
    </div>
</div>

