<meta charset="utf-8">
<!-- Icons -->
<link rel="shortcut icon" href="../sitefiles/favicon.ico">	
<meta name="msapplication-TileColor" content="#FEF2E6">
<meta name="msapplication-TileImage" content="../sitefiles/favicon.png">	
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../sitefiles/css/bootstrap.min.css">
<link rel="stylesheet" href="../sitefiles/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="../sitefiles/css/summernote.css" type="text/css">
<link rel="stylesheet" href="../sitefiles/css/prettify.css" type="text/css">
<link rel="stylesheet" href="../sitefiles/css/nprogress.css" type="text/css">
<link rel="stylesheet" href="../sitefiles/css/font-awesome.min.css" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="../sitefiles/js/html5shiv.js"></script>
  <script src="../sitefiles/js/respond.min.js"></script>
<![endif]-->

<!--[if lt IE 7]>
  <link rel="stylesheet" href="../sitefiles/css/font-awesome-ie7.css" type="text/css">
<![endif]-->

<link rel="stylesheet" href="../sitefiles/css/admin-css.css" type="text/css">

<!-- js文件 -->
<script src="../sitefiles/js/jquery.min.js"></script>
<script src="../sitefiles/js/jquery.pjax.min.js"></script>
<script src="../sitefiles/js/bootstrap.min.js"></script>
<script src="../sitefiles/js/jasny-bootstrap.min.js"></script>
<script src="../sitefiles/js/summernote.min.js"></script>
<script src="../sitefiles/js/prettify.js"></script>
<script src="../sitefiles/js/nprogress.js"></script>
<script src="../sitefiles/js/admin-js.js"></script>

<?php
	function is_pjax() { //place here to make sure this can be used in everypage
		return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']=== 'true';   
	}
?>
<script>
	$(document).pjax('[nav-pjax] a', '#mainContent');
	$(document).on('pjax:send', function() {
		NProgress.start()
	})
	$(document).on('pjax:complete', function() {
		NProgress.done()
	})
</script>