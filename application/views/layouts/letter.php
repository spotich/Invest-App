<html>
<head>
    <title>Two Factor Authentication</title>
</head>
<body>
<p>Someone was trying to enter your account</p><br>
<p>if it was you, please follow the link</p>
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/authenticate/<?php echo $id; ?>-<?php echo $two_factor_authentication_code; ?>">Veify</a>
</body>
</html>