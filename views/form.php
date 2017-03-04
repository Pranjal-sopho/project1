<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?></title>
</head>
<body>
<form action="index.php" method="post">
   
    <p>
       Select the city of your choice
    </p>
    <p>
       
       <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="city" placeholder="Enter city" type="text"/>
        </div>
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>