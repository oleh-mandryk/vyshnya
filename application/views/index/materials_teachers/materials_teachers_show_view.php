<div class="materials">
<? $id=null; $i=1; $result=null;?>
<ul>
    <?foreach($materials_teachers_all as $mat_teach):?>
    <?$result=$i%2;?>
    <?if ($result===0) { $id='last';}?>
    
    <li class="<?=$id?>">
        <p class="count_views">Додав: <?=$mat_teach->author?></p>
        <p class="date"><?=$mat_teach->date?></p>
        <h2><?=html::image('media/img/small_img_material/' . $mat_teach->menu->small_img_url, array('alt'=>'Міні-іконка', 'width' => '45', 'height' => '45'))?><?=$mat_teach->title?></h2>
          <p><?=$mat_teach->intro;?></p>
          <?if(!$auth->logged_in('login')):?>
          <p class="auth_update">Щоб закачати матеріал, потрібно спочатку авторизуватись.</p>
          <?else:?>
          <form>
            <p class="readmore"><input class="submit" type="button" value="Завантажити" onclick="location.href='/media/files/materials_teachers/<?=$mat_teach->url_material?>'"/></p>
          </form>
          <?endif?>
          
        </li>
        <? if ($result===0) { $id='prevLast';} else {$id=null;} $i++;?>
        <?endforeach?>
</ul>
<br class="clear" />
<?=$pagination?>
</div>