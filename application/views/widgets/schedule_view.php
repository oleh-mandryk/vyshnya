<a href="/page/legaladvice#top"><div class="legaladviceSidebar"></div></a>
<div class="menuRight">
<h2>Розклад занять</h2>
    <?$cl=null?>
        <ul>
        <?foreach ($schedule as $name => $schedule):?>
        <?if(in_array($select, $schedule))
        {
            $cl='active';
        }
        else
        {
            $cl='null';
        }?>
        <li class="<?=$cl?>">
        <?=Html::anchor(''. $schedule[0], $name)?>
        
        
        </li>
        <?endforeach?>
        </ul>
</div>