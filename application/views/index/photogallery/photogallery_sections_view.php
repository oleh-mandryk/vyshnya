<div class="photogallery">
<? $id=null; $i=1; $result=null;?>
<ul>
    <?foreach($photo_sections as $photo_sec):?>
    <?$result=$i%2;?>
    <?if ($result===0) { $id='last';}?>
    
    <li class="<?=$id?>">
        <p class="count_views">Кількість зображень: <?=$photo_sec->photos_one->count_all()?></p>
        <p class="date">Останнє: <?=$photo_sec->photos_one->order_by('date','desc')->where('publish_id','=',1)->find()->date?></p>
        <h2>
            <?if ($photo_sec->photos_one->count_all() != 0) {
                $img_url = $photo_sec->photos_one->order_by('date','desc')->where('publish_id','=',1)->find()->url_img;
            }
            else {
                $img_url = 'empty_section.jpg';
            }?>
            <?=html::image('media/img/photogallery/small/' . $img_url, array('alt'=>'Міні-іконка'))?>
            <?=$photo_sec->title?>
        </h2>
          <p><?=$photo_sec->intro;?></p>
          <p class="readmore"><?=HTML::anchor('photogallery/' . $photo_sec->alias, 'Переглянути')?></p>
        </li>
        <? if ($result===0) { $id='prevLast';} else {$id=null;} $i++;?>
        <?endforeach?>
</ul>
<br class="clear" />
</div>