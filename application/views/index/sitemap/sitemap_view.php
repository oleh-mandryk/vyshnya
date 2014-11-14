<?$k=0; $l=FALSE?>
<div class="sitemap">
<?foreach($menu_main_map as $map):?>
<?switch($map->lvl)
    {case 1: $p='a'; break; case 2: $p='b'; break;}?>
    <?if($map->title == 'Головна')
    {?>
        <p class="<?=$p?>"><?=Html::anchor(''.$map->pages->alias, $map->title)?></p>
        <?$photo_map = $map->count()?>
    <?}else
    {?>
    
        <?if ($k == $photo_map)
                    {?>
                       <p class="b"><?=Html::anchor('photogallery', 'Фотогалерея')?></p>
                   <?  $l == TRUE; }?>
        <?if ($l != TRUE) {
            $k++;
        }?>
        
        <p class="<?=$p?>"><?=Html::anchor('page/'.$map->pages->alias, $map->title)?></p>
        
        <?}?>
<?endforeach?>
<p class="a"><?=Html::anchor('new', 'Новини')?></p>
<?foreach($news_map as $map):?>
<p class="b"><?=Html::anchor('new/show/'.$map->id, $map->title)?></p>
<?endforeach?>        
        <p class="a"><?=Html::anchor('page/contact', 'Контакти')?></p>
        <p class="a"><?=Html::anchor('/sitemap', 'Карта сайту')?></p>
</div>