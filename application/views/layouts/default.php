<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script defer type="text/javascript" src="js/menu.js"></script>
</head>
<body>
    <?php echo $menu; ?>
    <?php echo $content; ?>
</body>
</html>