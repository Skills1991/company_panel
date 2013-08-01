<section id="page_department">

    <header>
        <div class="head-job">
            <?=$model->head_job->name?>:
            <? if ($model->head_job->user): ?>
                <a href="/personal/edit/<?= $model->head_job->user->id ?>"
                   target="_blank"><?=$model->head_job->user->getFullName()?></a>
            <? else: ?>
                Нет сотрудника
            <? endif; ?>
        </div>

        <div class="buttons">
            <a href="/departments/create/?root=<?= $model->id ?>" data-header="Новое подразделение"
               class="btn btn-popup btn-success btn-add-department">Добавить подразделение</a>
            <a href="/jobs/create/?root=<?= $model->id ?>" data-header="Новая должность"
               class="btn btn-popup btn-success btn-add-job">Добавить должность</a>
        </div>
    </header>

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

        <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
           data-content="' . nl2br($item['model']->functions) . '" data-original-title="Функции"></a>

                     <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
           data-content="' . nl2br($item['model']->result) . '" data-original-title="Результат"></a></span>
            <a class="icon-edit btn-popup"  href="/departments/edit/' . $item['model']->id . '" data-header="' . $item['model']->name . '"></a>
                    <a href="/departments/delete/' . $item['model']->id . '" class="icon-remove"></a>
                </div>
            <ul>';

            foreach ($item['children'] as $ind => $child) {
                rec_print($_this, $child, $level + 1, (empty($prefix) ? '' : $prefix . '.') . $num, $ind + 1);
            }

            foreach (Job::model()->findAllByAttributes(array('department_id' => $item['model']->id)) as $job) {
                $_this->renderPartial('//organization//_person_item', array('job' => $job));
            }

            echo '</ul></li>';
        }

        ?>

        <table class="departments-table">
            <tbody>
            <tr>

                <? foreach (Department::model()->findAllByAttributes(array('parent_id' => $model->id)) as $root_department): ?>
                    <td style="width: 33%">
                        <div class="department-header">
                            <h3><?=$root_department->name?>

                                <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
                                   data-content="<?=$root_department->functions?>" data-original-title="Функции"></a>

                                <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
                                   data-content="<?=$root_department->result?>" data-original-title="Результат"></a></span>

                                <a class="icon-edit btn-popup"  href="/departments/edit/<?=$root_department->id?>" data-header="<?=$root_department->name?>"></a>
                                <a href="/departments/delete/<?=$root_department->id?>" class="icon-remove"></a>

                            </h3>

                        </div>
                        <div class="department-content">
                            <? $tree = Department::GetTree($root_department->id);?>
                            <? if (!empty($tree['children'])): ?>
                                <ul>
                                    <? rec_print($this, $tree); ?>
                                </ul>
                                <? else: ?>
                                <p class="empty">пусто</p>
                            <? endif; ?>
                        </div>
                    </td>
                <? endforeach; ?>

            </tr>
            </tbody>
        </table>






    <? endif; ?>


    <footer>
        C помощью этого блока, Вы можете справедливо распределить работу между сотрудниками, обозначить правильную
        подчиненность и избежать ситуации, когда один человек бегает то к началу «конвейера» бизнеса то в конец, пытаясь
        везде успеть и произвести продукт.
    </footer>
</section>

