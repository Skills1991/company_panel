<div class="head-block" data-id="<?= $job->id ?>">
    <div class="view-mode">
        <div class="actions">
            <a href="/jobs/edit/<?=$job->id?>" class="icon-edit btn-popup" data-header="<?=$job->name?>"></a>
            <a href="#" class="icon-remove action-remove"></a>
        </div>
        <span class="person-name"><?=$job->user ? $job->user->getFullName() : 'Не указан';?></span>
        <span class="job-name"><?=$job->name?></span>
    </div>
</div>