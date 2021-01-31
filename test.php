<?php
echo "Admin : ".password_hash("admin", PASSWORD_DEFAULT);
echo "<br>";
echo "User : ".password_hash("user", PASSWORD_DEFAULT);
?>