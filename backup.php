<?php

set_error_handler(function($errno, $errstr, $errfile, $errline) {
	
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

date_default_timezone_set( 'Asia/Shanghai' );
$dateNow = date( 'Ymd' , ( time() - 24 * 60 * 60 ) );
$dirName = date( 'Ym' , ( time() - 24 * 60 * 60 ) );
if( !is_dir( './backup/' . $dirName ) )
{
	mkdir( './backup/' . $dirName );
}

$leftTxt = file_get_contents( '/home/nodePad/left.txt' );
$rightTxt = file_get_contents( '/home/nodePad/right.txt' );

try
{
	file_put_contents( '/home/nodePad/backup/' . $dirName . '/left' . $dateNow , $leftTxt );
	file_put_contents( '/home/nodePad/backup/' . $dirName . '/right' . $dateNow , $rightTxt );
}
catch(ErrorException $e)
{
	file_put_contents( '/home/nodePad/error.log' , date('Y-m-d h:i', time()) . '-------'.$e->getMessage().'------fail\r\n', FILE_APPEND );
}


