
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
<form method="get" action="test_FirstPage.php" >
    <?php
    echo "<div><h1>Пройдите тест. Тест состоит из трех блоков вопросов.</h1></div>";
    echo "<div><input type='text' name='name'><label>введите имя</label></div><br>";
    echo "<div><input type='submit' value='Начать тест' id='sub'></div> </form>";
    ?>
</body>
</html>

