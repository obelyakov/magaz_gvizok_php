    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Админка</title>
		<link rel="stylesheet" href="/css/admin/dashboard/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="/css/admin/dashboard/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="/css/admin/dashboard/colour.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="/css/admin/jquery-ui-1.8.17.custom.css" type="text/css" media="screen" charset="utf-8" />
                <script type="text/javascript" src="/js/jquery-1.6.js"></script>
                <script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
	</head>
	<body>

            <h1 id="head">Админ-панель</h1>
            <?if(isset($menu)):?>
            <ul id="navigation">
                <?foreach($menu as $v):?>
                    <?if(isset($v['active'])):?>
                        <li><span class="active"><?=$v['name']?></span></li>
                    <?else:?>
                        <li><a href="/admin/<?=$v['href']?>"><?=$v['name']?></a></li>
                    <?endif;?>
                 <?endforeach;?>
            </ul>
            <?endif;?>

            <div id="content" class="container_16 clearfix">
                <div class="grid_21">
                    <?=$this->load->view('admin/'.$container);?>
                </div>
            </div>

            <div id="foot">
                <i>Designed by </i><a href="http://mathew-davies.co.uk/">Mathew Davies</a>
            </div>

	</body>
</html>