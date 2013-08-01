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
        <button class="btn btn-success btn-mini btn-popup" data-action="/jobs/create?head=1"
                data-header="Новый директор">Новый директор
        </button>
    </div>

    <div class="departments-wrapper">

                <div class="departments-container">

                    <div class="cont-header">
                        <h2>Отделы</h2> <a href="/departments/create/?head=1" data-header="Новый отдел"
                                           class="btn-popup btn btn-success btn-mini">Новый отдел</a>
                    </div>

                    <table class="departments-row"><tbody><tr>

                        <? $departments = Department::model()->findAllByAttributes(array('parent_id' => 0)); $users = User::model()->findAll(); ?>

                        <? if (empty($departments)): ?>
                            <p class="empty">Нет отделов</p>
                        <? else: ?>

                            <? foreach ($departments as $ind => $department): ?>
                                <? $this->renderPartial('//organization//_department_root', array('department' => $department)); ?>
                            <? endforeach; ?>

                        <? endif; ?>
                        </tr></tbody></table>
                </div>

                <div class="department-container">
                    <input type="hidden" id="active_department_id">

                    <div class="loader"><img src="/img/loading-icons/loading5.gif"></div>
                    <div class="department-content">

                    </div>
                </div>

    </div>

    <script>
        // Открытие первого раздела по умолчанию
        $(function () {
            if ($('.departments-row .department').length) {
                $('.departments-row .department:first').find('.btn-open').trigger('click');
            }
        });
    </script>

    <div class="popup" id="organization_popup" style="display: none">
        <div class="popup-header">
            <h2></h2>
            <a href="#" class="close-popup"></a>
        </div>

        <div class="popup-loader"></div>

        <div class="popup-content">

        </div>
    </div>