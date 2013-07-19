<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="description" content="">
    <meta name="author" content="Vital Ozierski, ozicoder@gmail.com">
    <title></title>

    <link rel="shortcut icon" href="">

    <link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/lib/font-awesome/css/font-awesome.css">

    <link rel="stylesheet/less" type="text/css" href="/stylesheets/theme.less">
    <link rel="stylesheet/less" type="text/css" href="/stylesheets/styles.less">

    <script src="/lib/less/less-1.3.3.min.js" type="text/javascript"></script>

    <? Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <? Yii::app()->clientScript->registerCoreScript('yiiactiveform'); ?>

    <script src="/lib/jquery/jquery.blockUI.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.js"></script>




    <script type="text/javascript" src="/lib/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/lib/DataTables-1.9.4/media/js/jquery.dataTables.bootstrap.js"></script>

    <!--[if lt IE 9]>
    <script src="/lib/html5/html5shiv.js"></script>
    <![endif]-->

    <? if($this->active_page == 'organization'): ?>
        <script src="/js/organization.js"></script>
        <script src="/js/organization_department.js"></script>
    <? endif; ?>

</head>

<!--[if lt IE 7 ]>
<body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>
<body class="ie ie7"> <![endif]-->
<!--[if IE 8 ]>
<body class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>
<body class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body>
<!--<![endif]-->

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">

            <!--<li class="hidden-phone"><a href="#" role="button">Настройки</a></li>-->
            <li id="fat-menu" class="dropdown">
                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user"></i> <?=Yii::app()->user->getModel()->getFullName();?>
                    <i class="icon-caret-down"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="/logout">Выход</a></li>
                </ul>
            </li>

        </ul>
        <a class="brand" href="/">AstraMediaGroup</a>
    </div>
</div>

<div id="main-menu">

    <ul class="nav nav-tabs">
        <li<?=$this->active_page == 'organization' ? ' class="active"' : ''?>><a href="/organization"><i class="icon-dashboard"></i> <span>Оргструктура</span></a></li>
        <li<?=$this->active_page == 'personal' ? ' class="active"' : ''?>><a href="/personal"><i class="icon-bar-chart"></i> <span>Персонал</span></a></li>
    </ul>
</div>


<div id="sidebar-nav">

    <ul id="dashboard-menu" class="nav nav-list">
        <li<?=$this->active_page == 'organization' ? ' class="active"' : ''?>><a href="/organization"><i class="icon-home"></i><span>Оргструктура</span></a></li>
        <li<?=$this->active_page == 'personal' ? ' class="active"' : ''?>><a href="/personal"><i class="icon-bar-chart"></i><span>Персонал</span></a></li>
    </ul>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 main-content">
                <?=$content?>
            </div>
        </div>
    </div>
</div>

</body>
</html>