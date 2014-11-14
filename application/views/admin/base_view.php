<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    
    <title><?=$site_name?> | <?=$title?></title>   
    
    <link href="/media/img/favicon.ico" rel="shortcut icon" media="screen" />
    
    <?foreach ($styles as $file_style):?>
        <?=html::style($file_style)?>
    <?endforeach?>
    <?foreach ($scripts as $file_script):?>
        <?=html::script($file_script)?>
    <?endforeach?>
    
</head>
<body>
    <div class="wrapper wrap_header">
        <div id="header">
                
        </div>
    </div>

    <div class="wrapper wrap_title">
        <div id="title">
        
        </div>
    </div> 

    <? if (isset($block_menu_main)):?>
    <div class="wrapper wrap_menuMain">
        <div id="menuMain">
            <? foreach ($block_menu_main as $mmblock):?>
                <?=$mmblock?>
            <?endforeach?>
        </div>
        
    </div>
    <?endif?>

    <div class="wrapper wrap_container">
        <div id="container">
            <? if (isset($block_main_content)):?>
                <div id="mainContent">
                    <h1><?=$page_title?></h1>
                    <?=$submenu?>
                    <? foreach ($block_main_content as $mblock):?>
                            <?=$mblock?>
                        <?endforeach?>
                </div>
            <?endif?>
        </div>
    </div>

<div class="wrapper wrap_copyright">
    <div id="copyright">
        <p>Copyright &copy; 2007-2012 Вишнянський коледж ЛНАУ. Всі права застережено. Розробка і підтримка О.М.Мандрик, М.С.Мандрик.</p>
    </div>
</div>

</body>
</html>