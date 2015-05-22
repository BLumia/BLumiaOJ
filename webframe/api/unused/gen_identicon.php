<head>
	<script src="../sitefiles/js/pnglib.js"></script>
	<script src="../sitefiles/js/identicon.js"></script>
	<title> Identicon Generater </title>
</head>
<?php
/*
	Identicon Generater.
	Edit by BLumia for Avatar identicon usage.
	Usage: url.to.this/api.php?str={String}&size={Size}
	Default: size=61, show usage if don't get a identicon string.
	Source from http://identicon.net
	Identicon Js GitHub: https://github.com/stewartlord/identicon.js
	Robert Eisele's PNGlib are required.
*/
	if (isset($_GET['str'])) {
		$iden_str = $_GET['str'];
	} else {
		echo "Usage: url.to.this/api.php?str={String}&size={Size}";
		exit(0);
	}
	if (isset($_GET['size'])) 
		$iden_size = intval($_GET['size']);
	else
		$iden_size = 64;
	if (function_exists('hash')) {
		$iden_hash = hash('ripemd160', $iden_str);//it is said that github are using ripemd160 for identacon, is that so?
	} else {
		$iden_hash = md5($iden_str);
	}
?>
<body>
	<script type="text/javascript">
    var data = new Identicon(<?php echo "'".$iden_hash."',".$iden_size;?>).toString();
    document.write(
        '<img width=<?php echo $iden_size;?> height=<?php echo $iden_size;?> src="data:image/png;base64,' + data + '">'
    );
	</script>
</body>

