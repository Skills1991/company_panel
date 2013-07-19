<? if (!$job): ?>
    <div class="job-item no-found">Должность не найдена!</div>
<? else: ?>
    <div class="job-item" data-id="<?= $job->id ?>">

        <? if ($job->user): ?>
            <a href="/personal/load_popover/<?= $job->user->id ?>" class="icon-user popover-btn" rel="popover"
               data-placement="top" data-original-title="<?= $job->user->getFullName(); ?>"></a>
        <? endif; ?>

        <span class="job-name"><?=$job->name?></span> -

        <? if ($job->user): ?>
            <a target="_blank" href="/personal/edit/<?= $job->user->id ?>"
               class="user-name"><?=$job->user->getFullName()?></a>
        <? else: ?>
            <span class="user-empty">Нет сотрудника</span>
        <? endif; ?>

        <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
           data-content="<?= nl2br($job->functions); ?>" data-original-title="Функции"></a>
        <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
           data-content="<?= nl2br($job->result); ?>" data-original-title="Результат"></a>

        <a href="#" class="icon-edit btn-popup" data-action="/jobs/edit/<?=$job->id?>" data-header="<?=$job->name?>"></a>
        <a href="#" class="icon-remove"></a>

    </div>
<? endif; ?>