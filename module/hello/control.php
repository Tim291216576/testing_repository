<?php
#echo 'Hello,world!';
class hello #extends control
{
	public function world()
	{
		echo 'Hello,world!';
	}
}
$mytest=new hello();
$mytest->world();

?>