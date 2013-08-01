<div id="page_personal" class="list-page">
    <h1>Персонал</h1>

    <div class="list-buttons">
        <a href="/personal/create" class="btn btn-success">Новый сотрудник</a>
    </div>

    <table class="table table-first-column-number data-table display full">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя сотрудника<span class="sort-icon"><span></th>
            <th>E-mail<span class="sort-icon"><span></th>
            <th>Телефон<span class="sort-icon"><span></th>
            <th>Действия<span class="sort-icon"><span></th>
        </tr>
        </thead>
        <tbody>

        <? foreach (User::model()->findAll() as $user): ?>


            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->getFullName();?></td>
                <td><?=$user->email?></td>
                <td><?=$user->phone?></td>
                <td class="actions">
                    <a href="/personal/edit/<?= $user->id ?>" class="btn btn-mini btn-success">Изменить</a>
                    <a href="#" class="btn btn-mini btn-danger">Удалить</a>
                </td>
            </tr>

        <? endforeach; ?>

    </table>
</div>

<script type="text/javascript">
    $(function () {


        $('table.data-table.full').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""f>t<"F"lp>',
            "sPaginationType": "bootstrap",

        });
    });
</script>