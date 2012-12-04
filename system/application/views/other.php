<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/prettyPhoto.css" />
    <!--[if lt IE 9]><script src="/js/html5.js"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <title></title>
</head>
<body>
<div class="container">
    <header>
        <div class="wrapper">
            <div class="logo"><a href="#"></a></div>
            <div class="helper ib"></div>
            <div class="slogan">Ваш успех <strong>в квадрате!</strong></div>
        </div>

        <?=$this->load->view('top_menu');?>
    </header>

    <div class="layout-onecol">
        <div class="content">
            <div class="breadcrumbs">
                <?if(isset($breadcrumbs)):?>
                    <?foreach($breadcrumbs as $v):?>
                        <a href="<?=$v['path'];?>"><?=$v['name'];?></a>
                    <?endforeach;?>
                <?else:?>
                    <a href="#">Главная</a>
                <?endif;?>
            </div>
            <?=$this->load->view($container);?>

        </div>
    </div>
</div>

<footer>
    <div class="wrapper">
        <div class="logos">
            <img src="/i/sec.png" alt="SEC">
            <img src="/i/sjec.png" alt="SJEC">
        </div>
        <div class="copyright">&copy; 2012 Компания КВАДРАТ, все права защищены</div>
    </div>
</footer>

<script src="/js/libs-combined.js"></script>
<script src="js/jquery.prettyPhoto.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>