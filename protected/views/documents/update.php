<div id="page_department_single" class="single-page">
    <? $this->renderPartial('_form', array('model' => $model)); ?>
</div>
<?php if ($olderDocs != NULL): ?>
<div id="page_department_single" class="single-page">
    <h5>История изменений</h5>

    <table border="1" style="width: 100%">
    <?php
    foreach($olderDocs as $doc)
    {
echo <<<doc
<tr>
<td style="width:50px;">{$doc->date}</td>
<td>{$doc->comment}</td>
<td style="width:50px;"><a href="/documents/otkat/{$doc->id}">Откат</a></td>
</tr>
doc;

    }
    ?>
    </table>
</div>
<?php endif; ?>