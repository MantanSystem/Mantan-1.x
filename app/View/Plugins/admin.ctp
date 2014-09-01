<?php
	global $tmpVariable;
	foreach($tmpVariable as $key=>$value)
	{
		$$key= $value;
	}
	include($urlLocal['urlLocalPlugin'].'/'.$urlFilePlugin);
?>