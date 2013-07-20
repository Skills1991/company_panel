<div class="department" data-id="<?= $department->id ?>">
    <div class="department-header">
        <?= $ind + 1 ?>. <?= $department->name ?>

        <a href="/departments/delete/<?= $department->id ?>"
           onclick="return confirm('Вы уверены что хотите удалить отдел');" class="icon-remove"></a>
        <a href="/departments/edit/<?= $department->id ?>/?head=1"
           data-header="<?= $department->name ?>" class="btn-popup icon-edit"></a>

        <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
           data-content="<?= nl2br($department->result); ?>" data-original-title="Результат"></a></span>

        <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
           data-content="<?= nl2br($department->functions); ?>" data-original-title="Функции"></a>
    </div>

    <div class="department-person">

        <span class="job-name">
            <?= $department->head_job ? $department->head_job->name : '' ?>


            <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
               data-content="<?= nl2br($department->head_job->functions); ?>" data-original-title="Функции"></a>

            <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
               data-content="<?= nl2br($department->head_job->result); ?>" data-original-title="Результат"></a></span>


        <a href="/jobs/edit/<?= $department->head_job->id ?>/?head=1"
           data-header="<?= $department->head_job->name ?>" class="btn-popup icon-edit"></a>

        </span><br>

        <span class="user-name">

            <? if($department->head_job && $department->head_job->user): ?>

                    <a href="/personal/load_popover/<?= $department->head_job->user->id ?>" class="icon-user popover-btn" rel="popover"
                       data-placement="top" data-original-title="<?= $department->head_job->user->getFullName(); ?>"></a>

                <span><?=$department->head_job->user->getFullName(); ?>
                <? else: ?>

                <span class="empty-user">Нет сотрудника</span>

            <? endif; ?>

        </span>

        <div class="departament-open-container">
            <a href="#" class="btn btn-mini btn-primary btn-open">Открыть</a>
        </div>
    </div>
</div>