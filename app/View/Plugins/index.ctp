<?php
	global $tmpVariable;
	foreach($tmpVariable as $key=>$value)
	{
		$$key= $value;
	}
	
	if($urlFilePlugin)
	{
		include($urlLocal['urlLocalPlugin'].$urlFilePlugin);
	}
?>