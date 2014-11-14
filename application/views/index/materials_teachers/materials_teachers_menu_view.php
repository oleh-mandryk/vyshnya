<div class="materials">
<? $id=null; $i=1; $ii=0; $iii=0; $result=null;?>
<ul>
    <? foreach ($menu_materials_teachers_ft as $m_mat_teach ) :?>
    <? $result=$i%2;?>
    <?if ($result===0) { $id='last';}
    if ($ii==0)
    {?>
        <li class="<?=$id?>">
    <?}?>
       
        <?if ($m_mat_teach->is_root())
        
    {
        $chil = $m_mat_teach->count();
        ?>
        <h2><?=html::image('media/img/small_img_material/' . $m_mat_teach->small_img_url, array('alt'=>'Міні-іконка', 'width' => '45', 'height' => '45'))?><?=$m_mat_teach->title?></h2>
     <?
      $ii ++;
     }
     else
     {?>
        <?=HTML::anchor('materialsteachers/show/' . $m_mat_teach->id, $m_mat_teach->title).'.'?>
     <?
     $iii ++;
     }?>     
     
    
   <? if ($iii==$chil)
    {
        $ii=0; $iii=0;?> 
        <? if ($result===0) { $id='prevLast';} else {$id=null;} $i++;?>
        </li>  
    <?}?>
        
        <?endforeach?>
</ul>
<br class="clear" />
</div>