<div id="page_personal" class="list-page">
    <h1>Документы</h1>

    <div class="bs-docs-example">
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading"><a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion2"><br />
                    Рубрикатор<br />
                </a></div>
            <div class="accordion-body collapse in" id="collapseOne">
                <div class="accordion-inner">
                    <div class="list-buttons" style="float:right;">
                        <a href="/docheadings/create" class="btn btn-success">Добавить рубрику</a>
                    </div>
                    <?php
                    Docheadings::getHeadings();
                    ?>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading"><a class="accordion-toggle" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion2"><br />
                    Типы<br />
                </a></div>
            <div class="accordion-body collapse" id="collapseTwo">
                <div class="accordion-inner">
                    <div class="list-buttons" style="float:right;">
                        <a href="/doctypes/create" class="btn btn-success">Добавить тип</a>
                    </div>
                    <form id="types" method="POST" action="/documents/index">
                    <?php
                    Doctypes::getTypes();
                    ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading"><a class="accordion-toggle" href="#collapseThree" data-toggle="collapse" data-parent="#accordion2"><br />
                    Оргструктура<br />
                </a></div>
            <div class="accordion-body collapse" id="collapseThree">
                <div class="accordion-inner">
                    <form id="departments" method="POST" action="/documents/index">
                    <?php
                    Department::render_level_list(Department::model()->findAll(new CDbCriteria(array('condition'=>'parent_id=0'))));
                    ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    <table class="table table-first-column-number data-table display full">
        <thead>
        <tr>
            <th>Тип<span class="sort-icon"><span></th>
            <th>Название<span class="sort-icon"><span></th>
            <th>Дата<span class="sort-icon"><span></th>
            <th>Автор<span class="sort-icon"><span></th>
            <th>Действия<span class="sort-icon"><span></th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbody">

        <?
        $used = array();
        foreach ($model as $doc):
            if (!in_array($doc->family, $used))
            {
                $used[] = $doc->family;
            ?>


            <tr>
                <td><?=$doc->type->name?></td>
                <td><?=$doc->name;?></td>
                <td><?=$doc->date;?></td>
                <td>
                    <span class="userInfo" id="<?=$doc->user->id; ?>"><?=$userJob->name.": ".$doc->user->surname." ".$doc->user->name." ".$doc->user->father_name;?></span><br>
                    <div class="userInfoView">
                        <p><strong>E-mail:</strong> <?=$doc->user->email; ?></p>
                        <p><strong>Телефон:</strong> <?=$doc->user->phone; ?></p>
                    </div>
                </td>
                <td class="actions">
                    <button class="btn btn-success btn-mini btn-popup" data-action="/documents/update/<?=$doc->id; ?>"
                                 data-header="Обновить документ">Обновить документ
                    </button>
                    <a href="<?=Yii::app()->baseUrl.DIRECTORY_SEPARATOR.$doc->link;?>" class="btn btn-mini btn-success">Скачать</a>
                </td>
                <td>Доступ</td>
            </tr>

        <?
            }
        endforeach;?>
        </tbody>
    </table>
</div>

<div style="clear:both;"></div>

<div class="head-buttons">
    <button class="btn btn-success btn-mini btn-popup" data-action="/documents/create"
            data-header="Новый документ">Новый документ
    </button>
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

<?php  //echo "<script>var x=".((isset($_GET['heading'])?(int)$_GET['heading']: 0)."</script>"; ?>
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