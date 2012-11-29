<html>
<head>
<link href="uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript" src="jquery.uploadify.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	$('#file_upload').uploadify({
	'uploader'  : 'uploadify.swf',
	'script'    : 'uploadify.php',
	'cancelImg' : 'uploadify-cancel.png',
	'folder'    : '/uploads',
	'auto'      : true
	});
});
</script>
</head>

<body>
<input id="file_upload" name="file_upload" type="file" />
<hr>
<embed src="uploadify.swf" />
</body>
</html>

<?php
?>