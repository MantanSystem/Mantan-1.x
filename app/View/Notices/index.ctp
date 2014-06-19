<?php
	$string1= explode('[function-', $infoNotice['Notice']['content']);
	$n= count($string1);
	if($n>1)
	{
		$fix= '';
		for($i=0;$i<$n;$i++)
		{
			if($i%2==1)
			{
				$string2= explode(']', $string1[$i]);
				if(count($string2)>1)
				{
					// $string2[0] : ham duoc goi den
					// $string2[1] : phan chuoi con lai (dang nghi ngo co 2 dau ])
					
					$string3= explode('-', $string2[0]);
					$fix= $fix.$string1[$i-1].$string3[0]().$string2[1];
				}
			}
		}
		$infoNotice['Notice']['content']= $fix;
	}
?>
<?php include($themeActive.'viewNews.php');?>
<?php showErrorMantanHeader();?>