<div class="news">
<h1>Новини та оголошення</h1>
<? $id=null; $i=1; $result=null;?>
<ul>
    <?foreach($all_news as $news):?>
    <?$result=$i%3;?>
    <?if ($result===0) { $id='last';}?>
    <li class="main <?=$id?>">
        <p class="count_views">Кількість переглядів: <?=$news->count_views?></p>
        <p class="date">Додано: <?=$news->date?></p>
        <h2><?=html::image('media/img/small_img_material/' . $news->small_img_url, array('alt'=>'Міні-іконка', 'width' => '45', 'height' => '45'))?><?=$news->title?></h2>
          <?=$news->intro;?>
          <p class="readmore"><?=HTML::anchor('news/show/' . $news->id, 'Читати далі')?></p>
        </li>
        <? if ($result===0) { $id='prevLast';} else {$id=null;} $i++;?>
        <?endforeach?>
</ul>
<br class="clear" />
<p><?=HTML::anchor('news/', 'Всі новини...')?></p>
</div>