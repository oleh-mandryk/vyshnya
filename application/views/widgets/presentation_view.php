<div id="featuredContent">
    <ul>
        <?foreach ($slides as $slide) :?>
        <li><img src="/media/img/presentation/<?=$slide->img_url?>" alt="" />
                    <div class="floater">
                        <h2><?=$slide->title?></h2>
                        <?=$slide->content?>
                        <p class="readmore"><?=HTML::anchor('page/' . $slide->pages->alias, 'Читати далі')?></p>
                        
                    </div>
                </li>
        <?endforeach?>
    </ul>
</div>