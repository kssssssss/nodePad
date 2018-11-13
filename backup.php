<?php

$leftTxt = file_get_contents('/home/nodePad/left.txt');
$rightTxt = file_get_contents('/home/nodePad/right.txt');

if($leftTxt)
{
    file_put_contents('/home/nodePad/backup/left'.date('Ymd'), $leftTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

if($rightTxt)
{
    file_put_contents('/home/nodePad/backup/right'.date('Ymd'), $rightTxt);
}else
{
    file_put_contents('/home/nodePad/backup/error.log', time().'------fail\r\n');
}

