<?php $_SESSION['SessionAuth'] = strtoupper(substr(MD5(rand(0,9999999)),0,10)); ?>
<input type="hidden" name="pageauth" value="<?php echo ($_SESSION["SessionAuth"]);?>" readonly>