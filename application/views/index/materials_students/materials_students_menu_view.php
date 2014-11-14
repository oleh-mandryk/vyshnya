<div class="materials">
<ul>
<?$ii=0; $iii=0; $a=0; $id_l=0; $id=null; $i=1; $result=null;?>
<?foreach ($menu_materials_students_ft as $m_mat_stud ):
        $result=$i%2;
        if ($result===0) {$id='last';}
        if ($ii==0)
        {?>
            <li class="<?=$id?>">
      <?}
        switch ($m_mat_stud->lvl)
        {
            //Якщо пункт головний
            case 1:
            
                $chil = $m_mat_stud->count();?>
                <h2><?=html::image('media/img/small_img_material/' . $m_mat_stud->small_img_url, array('alt'=>'Міні-іконка', 'width' => '45', 'height' => '45'))?><?=$m_mat_stud->title?></h2>    
                <?$ii ++;
            break;
            
            //Якщо підпункт предмет
            case 2:
                $ro = $m_mat_stud->root();
                $chil1 = $m_mat_stud->where('lvl','=','2')->where('parent_id','=',$ro)->count_all();
                if ($a==0)
                {
                    $id_l++;?>
                    <form action="/materialsstudents/show" method="post">
                    <select name="subject" id="subject<?=$id_l?>">
                    <option value="select">Виберіть предмет...</option>
              <?}?>
                <option value="<?=$m_mat_stud->id?>"><?=$m_mat_stud->title?></option>
                <?$iii++; $a++;
                if ($a==$chil1)
                {
                    $a=0; $ro=0;?>
                    </select>
              <?}     
            break;
            
            //Якщо підпункт матеріал
            case 3:

            $ro = $m_mat_stud->scope();
            $chil2 = $m_mat_stud->where('scope','=',$ro)->where('lvl','=','3')->count_all();
            if ($a==0)
            {?>
                <select onchange="submit();" name="material" id="material<?=$id_l?>">
                <option class="select" value="select">Виберіть матеріал...</option>
          <?}?>
            <option class="<?=$m_mat_stud->parent_id?>" value="<?=$m_mat_stud->id?>"><?=$m_mat_stud->title?></option>
            <?$iii++; $a++;            
            if ($a==$chil2)
            {
                $a=0; $ro=0;?>
                </select>
                
                </form>  
          <?}
            break;
        }
        if ($iii==$chil)
        {
            $ii=0; $iii=0;
            if ($result===0) {$id='prevLast';} else {$id=null;} $i++;?>
            </li>
      <?}?>
<?endforeach?>
</ul>
<br class="clear" />
</div>