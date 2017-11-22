<html>
    <head>
        <meta charset='utf-8'>
        <title>Podgląd <?php $tab = unserialize($_GET['tablica']);echo $tab['nazwa'];?></title>
        <style type='text/css'>
            body{
                background-color: black;
            }
        </style>
        <link rel="stylesheet" href="../style.css" />
    </head>
<body>
<?php

$tab = unserialize($_GET['tablica']);

echo $tab['nazwa'];
echo "<br>";
$path =  "../".$tab['path'];
echo $path;

echo "<div id='div-img-padglad'>";
    echo "<img src='$path' class=\"image-podglad\">";
echo "</div>";

?>
</body>
</html>
