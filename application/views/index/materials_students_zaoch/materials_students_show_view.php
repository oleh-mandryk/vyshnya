<div class="materials">
<? $id=null; $i=1; $result=null;?>
<ul>
    <?foreach($materials_students_all as $mat_stud):?>
    <?$result=$i%2;?>
    <?if ($result===0) { $id='last';}?>
    
    <li class="<?=$id?>">
        <p class="count_views">Автор: <?=$mat_stud->author?></p>
        <p class="date"><?=$mat_stud->date?></p>
        <h2><?=html::image('media/img/small_img_material/' . $mat_stud->menu->small_img_url, array('alt'=>'Міні-іконка', 'width' => '45', 'height' => '45'))?><?=$mat_stud->title?>
        <?if ($mat_stud->title_number != 0):?>
        №<?=$mat_stud->title_number?>
        <?endif;?>
        </h2>
          <p><?=$mat_stud->intro;?></p>
          <?if(!$auth->logged_in('login')):?>
          <p class="auth_update">Щоб закачати матеріал, потрібно спочатку авторизуватись.</p>
          <?else:?>
          
          <form>
            <p class="readmore"><input class="submit" type="button" value="Завантажити" onclick="location.href='/media/files/materials_students_zaoch/<?=$mat_stud->url_material?>'"/></p>
          </form>
          
          <?endif?>
        </li>
        <? if ($result===0) { $id='prevLast';} else {$id=null;} $i++;?>
        <?endforeach?>
</ul>
<br class="clear" />
<?=$pagination?>
</div>