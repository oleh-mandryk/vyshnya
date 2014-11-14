<div class="menuTop">

    <?$cl=null?>
        <ul>
        <?foreach ($menutop as $name => $menutop):?>
        <?if(in_array($select, $menutop))
        {
            $cl='active';
        }
        else
        {
            $cl='null';
        }?>
        <li class="<?=$cl?>">
        <?=Html::anchor(''. $menutop[0], html::image('media/img/'.$menutop[1]).$name)?>
        
        
        </li>
        <?endforeach?>
        </ul>
</div>