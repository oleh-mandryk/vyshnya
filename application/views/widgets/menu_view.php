<?$cl=null?>
<div id="styleone">
<ul>
  <?foreach ($menu as $name => $menu):?>
  <?if(in_array($select, $menu))
{
    $cl='current';
}
else
{
    $cl='null';
}?>
  <li class="<?=$cl?>">
  <?=Html::anchor('admin/'. $menu[0], $name)?>
  </li>
  
<?endforeach?>
</ul>
</div>