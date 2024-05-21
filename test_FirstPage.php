<?php
session_start();
$_SESSION['name']=$_GET['name'];
if(!isset($_GET['name']))
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
<div><h1>1.Выберите один правильный ответ</h1></div>
    <form method="post"  >
        <?php
        $s = array();
if(count($_POST)==0){
     //   session_start();
        quess($s);
    echo "<div><h4 style='color:red'>Вы не ответили ни на один вопрос</h4></div>";

}
else {

    $i = 0;
    foreach ($_POST as $ans) {
        $s[$i] = $ans;
        $i++;
    }
    if (count($_POST) < 10) {
        echo "<div><h4 style='color:red'>Ответьте на все вопросы</h4></div>";
        quess($s);
    } else {
        $result = 0;
        $s1 = array();
        $arr = file("test1.txt");
        $arr1 = explode("|", $arr[0]);
        for ($i = 0; $i < 10; $i++) {
            $arr2 = explode(";", $arr1[$i]);
            $c = count($arr2) - 1;
            $i1=$i+1;
            $ww=false;
            for($u=0;$u<count($_POST);$u++) {
                if ($_POST["r".$i1] == "v" . $i1 . ":" . $arr2[$c])
            $ww=true;}
            if($ww)
                $result +=1;
        }
      $_SESSION['result']=$result;
        header("Location:test_SecondPage.php");
       exit();
    }
}

function quess($s){
    $j=array('0'=>0 ,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
    if($s==null) {
        shuffle($j);
       $_SESSION['arr']=$j;
    }
   else
        $j=$_SESSION['arr'];
    $arr = file ("test1.txt");
    $arr1=explode("|",$arr[0]);
    for ($i=0;$i<10; $i++){
        $n=$i+1;
        $arr2=explode(";",$arr1[$j[$i]]);
        echo "<div><b>$n</b>.$arr2[1]</div>";
        for($a=2;$a<5;$a++) {
            $r="r".$arr2[0];
            $a1=$a-1;
            $v="v".$arr2[0].':'.$a1;
            $r1='radio'.$arr2[0];
            if($s!==null) {
                $q=true;
                for ($c = 0; $c < count($s); $c++) {
                    if ($s[$c] == $v)
                        $q=false;}
                    if(!$q)
                        echo "<div><input type='radio' class=$r1  checked='checked' name=$r value=$v><label >$arr2[$a]</label></div>";
                    else
                        echo "<div><input type='radio' class=$r1  name=$r value=$v><label >$arr2[$a]</label></div>";

            }
            else {
                echo "<div><input type='radio' class=$r1  name=$r value=$v><label >$arr2[$a]</label></div>";
            }
        }
        echo "<br>";
    }
    echo "<div><input type='submit' value='ответить' id='sub'></div> </form>";
}
?>
</body>
</html>
