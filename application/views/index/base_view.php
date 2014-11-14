<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="<?=$description?>"/>
    <meta name="keywords" content="<?=$keywords?>"/>
    
    <title><?=$site_name?> | <?=$title?></title>   
    
    <link href="/media/img/favicon.ico" rel="shortcut icon" media="screen" />
    <link href="/media/css/print.css" rel="stylesheet" media="print" type="text/css"/>
    
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
        <?=$block_header?>
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

<? if (isset($block_breadcrumb)):?>
<div class="wrapper wrap_breadcrumb">
  <div id="breadcrumb">
    <? foreach ($block_breadcrumb as $bblock):?>
        <?=$bblock?>
    <?endforeach?>
  </div>
</div>
<?endif?>

<? if (isset($block_featured_slide)):?>
<div class="wrapper wrap_featuredSlide">
    <div id="featuredSlide">
        <?=$block_featured_slide?>     
        <a href="javascript:void(0);" id="featured-item-prev"><img src="../media/img/prev.png" alt="" /></a> <a href="javascript:void(0);" id="featured-item-next"><img src="../media/img/next.png" alt="" /></a>
    </div>
</div>
<?endif?>

<div class="wrapper wrap_container">
    <div id="container">
        
        <? if (isset($block_content)):?>
        <div id="content">
            <h1><?=$page_title?></h1>
            <?=$submenu?>
                <div class="print"><a href ="javascript:window.print(); void 0; "><img src="/media/img/printer-icon.jpg"/></a></div>
                <? foreach ($block_content as $cblock):?>
                    <?=$cblock?>
                <?endforeach?>
                
        </div>
        <?endif?>
        
        <? if (isset($block_sidebar)):?>
        <div id="sidebar">
            <? foreach ($block_sidebar as $sblock):?>
                <?=$sblock?>
            <?endforeach?>
        </div>
        <?endif?>
        <br class="clear" />
        <? if (isset($block_main_content)):?>
        <div id="mainContent">
            <? foreach ($block_main_content as $mblock):?>
                        <?=$mblock?>
                    <?endforeach?>
        </div>
        <?endif?>
        
    </div>
</div>

<div class="wrapper wrap_bottomBar">
    <div id="bottomBar" class="clear">
    <div class="foot_contact">
      <h2>Адреса коледжу</h2>
      <address>
      Вишнянський коледж Львівськогого національного аграрного університету<br />
      с. Вишня, Городоцький район<br />
      Львівська область<br />
      Україна<br />
      81540
      </address>
      <ul>
        <li><strong>Тел:</strong> (03231) 25145</li>
        <li><strong>Факс:</strong> (03236) 45167</li>
        <li><strong>Email:</strong> college@vyshnya.lviv.ua</li>
        <li class="last"><strong>Веб-сайт:</strong> <a href="#">http://www.vyshnya.lviv.ua</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Корисні посилання</h2>
      <ul>
        <li><a target="blank" href="http://www.president.gov.ua"><img src="/media/img/footer_img/bann_pres.jpg"/></a></li>
        <li><a target="blank" href="http://portal.rada.gov.ua"><img src="/media/img/footer_img/bann_vru.jpg"/></a></li>
        <li><a target="blank" href="http://www.kmu.gov.ua/control"><img src="/media/img/footer_img/bann_kmu.jpg"/></a></li>
        <li><a target="blank" href="http://www.mon.gov.ua"><img src="/media/img/footer_img/banner_monu.jpg"/></a></li>
        <li><a target="blank" href="http://www.minagro.kiev.ua"><img src="/media/img/footer_img/bann_minagropol.jpg"/></a></li>
        <li><a target="blank" href="http://agroosvita.com"><img src="/media/img/footer_img/baner-smcae.jpg"/></a></li>
        <li><a target="blank" href="http://osvitportal.lviv.ua"><img src="/media/img/footer_img/osvita_portal.jpg"/></a></li>
        <li><a target="blank" href="http://www.lnau.lviv.ua"><img src="/media/img/footer_img/banner_lnau.jpg"/></a></li>
        <li><a target="blank" href="http://www.testportal.gov.ua"><img src="/media/img/footer_img/banner_zno.jpg"/></a></li>
        <li><a target="blank" href="http://www.ligazakon.ua"><img src="/media/img/footer_img/banner_ligazakon.jpg"/></a></li>
        <li><a target="blank" href="http://www.kaspersky.ru"><img src="/media/img/footer_img/banner_kis.jpg"/></a></li>
        <li><a target="blank" href="http://www.1c.ru"><img src="/media/img/footer_img/banner_1cv8.jpg"/></a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Ми в соціальних мережах</h2>
      <ul>
        <!--
<li><a href="#"><img src="/media/img/footer_img/banner_facebook.png"/></a></li>
-->
        <li><a target="blank" href="http://vk.com/club6917818"><img src="/media/img/footer_img/banner_vk.png"/></a></li>
        <li class="last"><a target="blank" href="http://www.odnoklassniki.ua/group/50683288158411"><img src="/media/img/footer_img/banner_odnok.png"/></a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Статистика</h2>
      <ul>
        <li><!--LiveInternet counter--><script type="text/javascript"><!--
                document.write("<a href='http://www.liveinternet.ru/click' "+
                "target=_blank><img src='//counter.yadro.ru/hit?t18.6;r"+
                escape(document.referrer)+((typeof(screen)=="undefined")?"":
                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                ";"+Math.random()+
                "' alt='Лічильник' title='LiveInternet: показано число просмотров за 24"+
                " часа, посетителей за 24 часа и за сегодня' "+
                "border='0' width='88' height='31'><\/a>")
                //--></script><!--/LiveInternet-->
		</li>
		<li>
			<!-- hit.ua -->
			<a href='http://hit.ua/?x=11159' target='_blank'>
			<script language="javascript" type="text/javascript"><!--
			Cd=document;Cr="&"+Math.random();Cp="&s=1";
			Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
			Cp+="&t="+(new Date()).getTimezoneOffset();
			if(self!=top)Cp+="&f=1";
			//--></script>
			<script language="javascript1.1" type="text/javascript"><!--
			if(navigator.javaEnabled())Cp+="&j=1";
			//--></script>
			<script language="javascript1.2" type="text/javascript"><!--
			if(typeof(screen)!='undefined')Cp+="&w="+screen.width+"&h="+
			screen.height+"&d="+(screen.colorDepth?screen.colorDepth:screen.pixelDepth);
			//--></script>
			<script language="javascript" type="text/javascript"><!--
			Cd.write("<img src='http://c.hit.ua/hit?i=11159&g=0&x=5"+Cp+Cr+
			"&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
			"' border='0' width='88' height='31' "+
			"alt='hit.ua: посетителей и просмотров за сегодня' title='hit.ua: посетителей и просмотров за сегодня'/>");
			//--></script>
			<noscript>
			<img src='http://c.hit.ua/hit?i=11159&amp;g=0&amp;x=5' border='0' width='88' height='31' alt='hit.ua: посетителей и просмотров за сегодня' title='hit.ua: посетителей и просмотров за сегодня'/>
			</noscript></a>
			<!-- / hit.ua -->
		</li>
		<li>
			<!-- I.UA counter --><a href="http://www.i.ua/" target="_blank" onclick="this.href='http://i.ua/r.php?137579';" title="Rated by I.UA">
			<script type="text/javascript" language="javascript"><!--
			iS='<img src="http://r.i.ua/s?u137579&p65&n'+Math.random();
			iD=document;if(!iD.cookie)iD.cookie="b=b; path=/";if(iD.cookie)iS+='&c1';
			iS+='&d'+(screen.colorDepth?screen.colorDepth:screen.pixelDepth)
			+"&w"+screen.width+'&h'+screen.height;
			iT=iD.referrer.slice(7);iH=window.location.href.slice(7);
			((iI=iT.indexOf('/'))!=-1)?(iT=iT.substring(0,iI)):(iI=iT.length);
			if(iT!=iH.substring(0,iI))iS+='&f'+escape(iD.referrer.slice(7));
			iS+='&r'+escape(iH);
			iD.write(iS+'" border="0" width="88" height="31" />');
			//--></script></a><!-- End of I.UA counter -->
		</li>
      </ul>
    </div>
    </div>
</div>

<div class="wrapper wrap_copyright">
    <div id="copyright">
        <p>Copyright &copy; 2007-2012 Вишнянський коледж ЛНАУ. Всі права застережено. Розробка і підтримка О.М.Мандрик, М.С.Мандрик.</p>
    </div>
</div>

</body>
</html>