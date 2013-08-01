<div class="head-block ceo-block" data-id="<?= $job->id ?>">
    <div class="view-mode">
        <div class="actions">


            <a href="/jobs/edit/<?= $job->id ?>" class="icon-edit btn-popup"
               data-header="<?= $job->name ?>"></a>
        </div>


        <span class="job-name"><?= $job->name ?>
            <a href="#" class="icon-stop popover-btn" rel="popover" data-placement="top"
               data-content="<?= nl2br($job->functions); ?>" data-original-title="Функции"></a>
            <a href="#" class="icon-caret-up popover-btn" rel="popover" data-placement="top"
               data-content="<?= nl2br($job->result); ?>" data-original-title="Результат"></a></span>
        <span class="person-name">
        <? if ($job->user): ?>
            <a href="/personal/load_popover/<?= $job->user->id ?>" class="icon-user popover-btn" rel="popover"
               data-placement="top" data-original-title="<?= $job->user->getFullName(); ?>"></a>
        <? endif; ?>
            <?= $job->user ? $job->user->getFullName() : 'Не указан'; ?></span>

    </div>
</div>