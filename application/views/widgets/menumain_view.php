<?$ii=0; $iii=0; $id=null; $ls=null; $a=1?>
<ul>
  <?foreach ($menu_main_ft as $menu_main):?>
  <?if ($ii==0)
    {?>
        <?if($select_it == $menu_main->id) { $id='active';} else { $id=null;}?>
        <?if($class_last==$a) { $ls='last';} $a++;?>
        
        <li class="<?=$id?> <?=$ls?>">
    <?}?>
  
  
    <?switch($menu_main->lvl)
    { 
        
        //якщо головний пункт
        case 1: ?>
        <?$chil = $menu_main->count();?>
        <?if($menu_main->title == 'Головна')
        {?>
        <?=Html::anchor(''.$menu_main->pages->alias, $menu_main->title)?>
        <?}else
        {?>
        <?=Html::anchor('page/'.$menu_main->pages->alias, $menu_main->title)?>
        <?}?>
        <?$ii ++;?>
        <?break;?>
        
        
        
        //якщо підпункт
        <?default ?>
        
        <?if ($iii==0)
        {?>
            <ul>
        <?}?>
            <? if($menu_main->pages->publish_id == 1) {?>
        
            <li><?=Html::anchor('page/'.$menu_main->pages->alias, $menu_main->title)?></li>
            <? } ?>
            <?$iii ++;?>
            <?if ($iii==$chil)
            {?>
                <?if ($menu_main->parent()->title == 'Головна')
                    {?>
                        <li><?=Html::anchor('photogallery', 'Фотогалерея')?></li>
                   <? }?>
                
            </ul>
            <?}?>
        
        <?break;?>

<?}?>            
  
<? if ($iii==$chil)
    {
        $ii=0; $iii=0;?> 
        <? ?>
        
        </li>  
    <?}?>  
  
<?endforeach?>
</ul>
<br class="clear" />