<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <style>
        div{background: light-green; border-radius: 10px;}
        p{font-size: 50px;}
    </style>
</head>
<body>
<div>
<?php
echo '<p>'.'Желаемая дата '.$formData['date'].'</p>'.'</br>';
echo '<p>'.'Фамилия '.$formData['firstname'].'</p>'.'</br>';
echo '<p>'.'Имя '.$formData['name'].'</p>'.'</br>';
echo '<p>'.'Телефон '.$formData['phone'].'</p>'.'</br>';
echo '<p>'.'Почта '.$formData['email'].'</p>'.'</br>';
?>
</div>
</body>
</html>
