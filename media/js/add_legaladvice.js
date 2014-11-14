function addLegaladvice(yes_no, row_id) {
    document.getElementById('infoBottom'+row_id).style.display='none';
    document.getElementById('infoBottomInfo'+row_id).style.display='block';
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.open('GET','/getlist/setnewlegaladvicevote?yes_no='+yes_no+'&row_id='+row_id,true);
    xmlhttp.send();
}