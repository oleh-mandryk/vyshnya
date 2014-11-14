<div class="menuRight">
<h2>Методичні матеріали</h2>
    <?$cl=null?>
        <ul>
        <?foreach ($methodicalmaterials as $name => $methodicalmaterials):?>
        <?if(in_array($select, $methodicalmaterials))
        {
            $cl='active';
        }
        else
        {
            $cl='null';
        }?>
        <li class="<?=$cl?>">
        <?=Html::anchor(''. $methodicalmaterials[0], $name)?>
        
        
        </li>
        <?endforeach?>
        </ul>
</div>