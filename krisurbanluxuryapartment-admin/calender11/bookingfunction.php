<?php
if(isset($_POST['action']))
{
	$url = $_POST['action'];
	$z = explode("&", $url);
	if(count($z)==1)
	{
	$z = explode("?", $url);
	array_pop($z);
	}
	if(count($z)>1)
	{
	foreach ($z as $key => $tag_name) {
    if($tag_name == "multi=remove")
        {
		unset($z[$key]);
    	}
	}
	}
?>
<?php
echo $k = implode("&", $z);
}
?>