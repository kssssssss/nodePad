<?php

include "./config.php";

$action = isset( $_POST['action'] ) ? $_POST['action'] : '';
$password = isset( $_GET['password'] ) ? $_GET['password'] : '';

if(empty($action))
{
	$nowClientId = (int)file_get_contents('clientId') ;
	$nowClientId++;
	file_put_contents('clientId', $nowClientId);
	$leftTxt = file_get_contents('left.txt');
	$rightTxt = file_get_contents('right.txt');
}else if($action = 'set')
{
    //轮询
	$nowClientId = $_POST['nowClientId'];
	$clientId = file_get_contents('clientId');
	if($nowClientId < $clientId)
	{
		echo 'timeout';
		return;
	}
	$leftTxt = isset( $_POST['lefttxt'] ) ? htmlspecialchars($_POST['lefttxt']) : '';
	$rightTxt = isset( $_POST['righttxt'] ) ? htmlspecialchars($_POST['righttxt']) : '';
	if(!empty($leftTxt))
    {
	    if(!file_put_contents('left.txt', $leftTxt))
        {
	        file_put_contents('error.log', time().'----left\n\r', FILE_APPEND);
        }
    }
	if(!empty($rightTxt))
	{
		if(!file_put_contents('right.txt', $rightTxt))
        {
	        file_put_contents('error.log', time().'----right\n\r', FILE_APPEND);
        }
	}
	die;
}

if($config['password'] != $password)
{
	echo '<p>deny</p>';
	return;
}

?>

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

<textarea style="width: 46%;height: 1000px;font-size: 18px;" id="leftTxt"><?php echo $leftTxt;?></textarea>
<textarea style="width: 46%;height: 1000px;font-size: 18px;" id="rightTxt"><?php echo $rightTxt;?></textarea>
<input id="nowClientId" type='hidden' value="<?php echo $nowClientId;?>" name='nowClientId'  />
<script>
    function setTxt () {
	var nowClientId = $("#nowClientId").val();
        var leftTxt = $( "#leftTxt" ).val();
        var rightTxt = $( "#rightTxt" ).val();
        $.ajax({
            url:"index.php",
            type:"post",
            data:{
                lefttxt:leftTxt,
                righttxt:rightTxt,
                action:'set',
		nowClientId:nowClientId
            },
            cache:false,
            success:function(msg)
            {
                console.log(msg);
            }
        })
    }

    setInterval("setTxt()", 2000);

</script>



