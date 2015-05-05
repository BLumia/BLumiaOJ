<?php $_SESSION['SessionAuth'] = rand(1000,9999); ?>
<input type="hidden" name="pageauth" value="<?php echo ($_SESSION["SessionAuth"]);?>" readonly>