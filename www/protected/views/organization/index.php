<?
$users = User::model()->findAll();
$ceo_job = Job::GetCEO();
$ceo_user = User::GetCEO();
?>

<div id="page_organization">
    <h1>Организация</h1>

    <? $this->renderPartial('//organization/_person_ceo_item', array('job' => $ceo_job)); ?>

    <? $heads = Job::GetHeads();$width = empty($heads) ? 0 : floor(100 / count($heads));?>

    <h2>Руководство</h2>
    <table class="heads-row">
        <tbody>
        <tr>
            <? foreach ($heads as $head): ?>
                <td style="width: <?= $width ?>%">
                   <? $this->renderPartial('//organization/_person_head_item', array('job' => $head)); ?>
                </td>
            <? endforeach; ?></tr>
        </tbody>
    </table>

    <div class="head-buttons">
        <button class="btn btn-success btn-mini btn-popup" data-action="/jobs/create?head=1" data-header="Новый директор">Новый директор</button>
    </div>

    <div class="departments-container">

        <div class="cont-header">
            <h2>Отделы</h2> <a href="/departments/create/?head=1" data-header="Новый отдел"
                               class="btn-popup btn btn-success btn-mini">Новый отдел</a>
        </div>

        <div class="departments-row">

            <? $departments = Department::model()->findAllByAttributes(array('parent_id' => 0)); $users = User::model()->findAll(); ?>

            <? if (empty($departments)): ?>
                <p class="empty">Нет отделов</p>
            <? else: ?>
                <? foreach ($departments as $ind => $department): ?>
                    <div class="department" data-id="<?= $department->id ?>">
                        <div class="department-header">
                            <?=$ind + 1?>. <?=$department->name?>
                            <a href="/departments/delete/<?= $department->id ?>"
                               onclick="return confirm('Вы уверены что хотите удалить отдел');" class="icon-remove"></a>
                            <a href="#" data-action="/departments/edit/<?= $department->id ?>/?head=1"
                               data-header="<?= $department->name ?>" class="btn-popup icon-edit"></a>
                        </div>
                        <div class="department-person">


                            <div class="head-form" style="display: none">
                                <select>
                                    <option value="0">Нет руководителя</option>
                                    <? foreach ($users as $user): ?>
                                        <option value="<?= $user->id ?>"><?=$user->getFullName();?></option>
                                    <? endforeach; ?>
                                </select>
                                <a href="#" class="btn btn-mini btn-success btn-save-head">Сохранить</a>
                            </div>
                        </div>
                        <div class="departament-open-container">
                            <a href="#" class="btn btn-mini btn-primary btn-open">Открыть</a>
                        </div>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>

    <div class="department-container">
        <input type="hidden" id="active_department_id">

        <div class="loader"><img src="/img/loading-icons/loading5.gif"></div>
        <div class="department-content">

        </div>
    </div>
</div>


<div class="popup" id="organization_popup" style="display: none">
    <div class="popup-header">
        <h2></h2>
        <a href="#" class="close-popup"></a>
    </div>

    <div class="popup-loader"></div>

    <div class="popup-content">

    </div>
</div>