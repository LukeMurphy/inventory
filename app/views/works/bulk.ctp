---<pre>
<?php

foreach ($works as $work) {

	echo $work['Work']['title'];
	echo $work['Work']['consignment'];
	echo $work['Work']['status'];
	
	
	echo "\n";
}
?>