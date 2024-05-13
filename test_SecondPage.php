<?php
session_start();
if(!isset($_SESSION["result"]))
{
    header("Location:index.php");
   exit();
}
$result = $_SESSION['result'];
echo "<div >Ваш результат за 1-й тест:&nbsp; <b>".$_SESSION['result']."</b></div>";
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
<div><h1>2.Выберите все правильные ответы( может быть несколько)</h1></div>
<form method="post"  >
    <?php

    if(count($_POST)==0){

    quess(null);
    ?>
</body>
</html>
<?php
}
else {
    //session_start();
    $s = array();
    $i = 0;
    foreach ($_POST as $ans) {
        $s[$i] = $ans;
        $i++;
    }
    if(!check()) {
        echo "<div><h4 style='color:red'>Ответьте на все вопросы</h4></div>";
        quess($s);
    }
    else {
      // $result = $_SESSION['result'];

            $t = 0;
            $s1 = array();
            $arr = file("test2.txt");
            $arr1 = explode("|", $arr[0]);
            for ($i = 0; $i < 10; $i++) {
                $arr2 = explode(";", $arr1[$i]);
                $c = count($arr2) - 1;
                $c1 = explode(",", $arr2[$c]);
                $q1 = false;
                $q2 = false;
                $q3 = false;
                $y1 = false;
                $y2 = false;
                $y3 = false;
                if (count($c1) == 1) {
                    if ($c1[0] == 1)
                        $y1 = true;
                    if ($c1[0] == 2)
                        $y2 = true;
                    if ($c1[0] == 3)
                        $y3 = true;
                }
                if (count($c1) == 2) {
                    if ($c1[0] == 1)
                        $y1 = true;
                    if ($c1[0] == 2)
                        $y2 = true;
                    if ($c1[0] == 3)
                        $y3 = true;
                    if ($c1[1] == 2)
                        $y2 = true;
                    if ($c1[1] == 3)
                        $y3 = true;
                }
                if (count($c1) == 3) {
                    $y1 = true;
                    $y2 = true;
                    $y3 = true;
                }
                $i1 = $i + 1;
                $sv1 = "ch" . $i1 . "_" . "1";
                $sv2 = "ch" . $i1 . "_" . "2";
                $sv3 = "ch" . $i1 . "_" . "3";
                if (isset($_POST[$sv1])) {
                    $q1 = true;
                }
                if (isset($_POST[$sv2])) {
                    $q2 = true;
                }
                if (isset($_POST[$sv3])) {
                    $q3 = true;
                }

                if ($q1 == $y1 && $q2 == $y2 && $q3 == $y3)
                    $result += 3;
            }
            $_SESSION['result'] = $result;
            header("Location: test_ThirdPage.php");
            exit();
        }

    }

function check()
{
    for ($i = 1; $i < 11; $i++){
        if(!isset($_POST["ch".$i."_"."1"])&&!isset($_POST["ch".$i."_"."2"])&&!isset($_POST["ch".$i."_"."3"]))
            return false;
    }
    return true;
}

function quess($s){
    $j=array('0'=>0 ,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
    if($s==null) {
        shuffle($j);
        $_SESSION['arr']=$j;
    }
    else
        $j=$_SESSION['arr'];
    $arr = file ("test2.txt");
    $arr1=explode("|",$arr[0]);
    for ($i=0;$i<10; $i++){
        $n=$i+1;
        $arr2=explode(";",$arr1[$j[$i]]);
        echo "<div><b>$n</b>.$arr2[1]</div>";

        for($a=2;$a< 5;$a++) {
            $v="v".$arr2[0].':'.($a-1);
            $d=$a-1;
            $r1='ch'.$arr2[0].".".$d;
            if($s!==null) {
                $q=true;
                for ($c = 0; $c < count($s); $c++) {
                    if ($s[$c] == $v)
                        $q=false;}
                if(!$q)
                    echo "<div><input type='checkbox'   checked='checked' name=$r1 value=$v><label >$arr2[$a]</label></div>";
                else
                    echo "<div><input type='checkbox'  name=$r1 value=$v><label >$arr2[$a]</label></div>";
            }
            else {
                echo "<div><input type='checkbox'   name=$r1 value=$v><label >$arr2[$a]</label></div>";
            }
        }
        echo "<br>";
    }
    echo "<div><input type='submit' value='ответить' id='sub'></div> </form>";
}
?>
