<?php
date_default_timezone_set('Asia/Shanghai');
$dateNow = date('Ymd', (time()-24*60*60));
$dirName = date('Ym', (time()-24*60*60));
mkdir('./'.$dirName);

$leftTxt = file_get_contents('/home/nodePad/left.txt');
$rightTxt = file_get_contents('/home/nodePad/right.txt');

if($leftTxt)
{
    file_put_contents('/home/nodePad/backup/'.$dirName.'/left'.$dateNow, $leftTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

if($rightTxt)
{
    file_put_contents('/home/nodePad/backup/'.$dirName.'/right'.$dateNow, $rightTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

