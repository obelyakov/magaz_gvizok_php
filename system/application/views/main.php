<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/css/style.css" />
    <!--[if lt IE 9]><script src="/js/html5.js"></script><![endif]-->
    <script src="/js/jquery-1.7.2.min.js"></script>
    <title></title>
</head>
<body>
<div class="container-main">
    <header>
        <div class="wrapper">
            <div class="logo"></div>
            <div class="helper ib"></div>
            <div class="slogan">Ваш успех <strong>в квадрате!</strong></div>
        </div>

        <?=$this->load->view('top_menu');?>
    </header>

    <div class="layout-twocols">
        <aside>
            <h2>Последние объекты</h2>

            <div class="carousel1">
                <i class="icon-prev2"></i>
                <i class="icon-next2"></i>
                <div class="scroller">
                    <ul>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 32 лифтов в ТРЦ АЭРОБУС</li>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 128 лифтов в ТРЦ АЭРОБУС</li>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 256 лифтов в ТРЦ АЭРОБУС</li>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 512 лифтов в ТРЦ АЭРОБУС</li>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 1337 лифтов в ТРЦ АЭРОБУС</li>
                        <li><a href="#"><img src="/temp/m-1_03.jpg"></a>Монтаж 65535 лифтов в торгово-развлекательном центре АЭРОБУС</li>
                    </ul>
                </div>
            </div>

            <h2>Бренды</h2>

            <div class="brands">
                <a href="#"><img src="/i/sec-big.png" alt="SEC"></a>
                <a href="#"><img src="/i/sjec-big.png" alt="SJEC"></a>
            </div>
        </aside>
        <div class="content">
            <h1><?=$text->title;?></h1>
            <?=$text->text;?>

        </div>
    </div>
</div>

<footer>
    <div class="wrapper">
        <div class="ib"></div>
        <div class="copyright">&copy; 2012 Компания КВАДРАТ, все права защищены</div>
    </div>
</footer>

<script src="/js/libs-combined.js"></script>
<script src="/js/script.js"></script>
</body>
</html>