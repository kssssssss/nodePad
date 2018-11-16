<?php
date_default_timezone_set('Asia/Shanghai');
$dateNow = date('Ymd', (time()-24*60*60));

$leftTxt = file_get_contents('/home/nodePad/left.txt');
$rightTxt = file_get_contents('/home/nodePad/right.txt');

if($leftTxt)
{
    file_put_contents('/home/nodePad/backup/left'.$dateNow, $leftTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

if($rightTxt)
{
    file_put_contents('/home/nodePad/backup/right'.$dateNow, $rightTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

