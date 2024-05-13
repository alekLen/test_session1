<?php
session_start();
if(!isset($_SESSION["result"]))
{
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Test1</title>
    <style>
        div{
            display: flex;
            justify-content: left;
            margin-bottom: 10px;
            padding-left: 100px;
        }
        label{
            padding-left: 20px;
        }
        #sub{
            padding: 5px;
            padding-left: 40px;
            padding-right: 40px;
            font-size: 1.2em;
            background-color: rosybrown;
            border: 1px solid black;
        }
    </style>
</head>
<body style="background-color: paleturquoise">
<?php
   //session_start();
echo "<div><h4>".$_SESSION['name']."</h4></div>";
echo "<div><h1>Ваш итоговый результат:</h1></div>";
echo "<div style='font-size: 3em'><b>".$_SESSION['result']."</b></div><br>";
echo "<div >(maximum 90)</div>";
session_destroy();

?>