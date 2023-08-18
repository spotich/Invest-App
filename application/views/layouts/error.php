<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $code; ?></title>
    <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row align-items-end">
        <div class="col">
            <h2 id="title"><?php echo $code?> error occured</h2>
            <button class="btn btn-primary btn-lg col w-75 mb-3" onclick="window.location.href='/'">Visit home page</button>
        </div>
        <div class="col">
            <img class="big-icon" src="../../img/computer.png">
        </div>
    </div>
</div>
</body>
</html>