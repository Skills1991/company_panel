<? if($model): ?>

    <div class="user-popover">
        <div class="param-row">
            <span class="param">Телефон</span>
            <span class="value"><?=$model->phone?></span>
        </div>
        <div class="param-row">
            <span class="param">E-mail</span>
            <span class="value"><?=$model->email?></span>
        </div>
    </div>

<? endif; ?>