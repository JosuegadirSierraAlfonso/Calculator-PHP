<?php
class Calculator {
    private $name1;
    private $value1;
    private $name2;
    private $value2;
    
    public function __construct() {
        $this->name1 = "num";
        $this->value1 = "";
        $this->name2 = "op";
        $this->value2 = "";
    }
    
    public function handleInput() {
        if (isset($_POST['num'])) {
            $this->num = $_POST['input'] . $_POST['num'];
        } else {
            $this->num = "";
        }
        
        if (isset($_POST['op'])) {
            $this->value1 = $_POST['input'];
            setcookie($this->name1, $this->value1, time()+(86400*5), "/");
            
            $this->value2 = $_POST['op'];
            setcookie($this->name2, $this->value2, time()+(86400*5), "/");
            $this->num = "";
        }
        
        if (isset($_POST['equal'])) {
            $this->num = $_POST['input'];
            switch ($_COOKIE['op']) {
                case "+":
                    $result = $_COOKIE['num'] + $this->num;
                    break;
                case "-":
                    $result = $_COOKIE['num'] - $this->num;
                    break;
                case "*":
                    $result = $_COOKIE['num'] * $this->num;
                    break;
                case "/":
                    if ($_COOKIE['num'] != 0) {
                        $result = $_COOKIE['num'] / $this->num;
                    } else {
                        $result = NAN;
                    }
                    break;
            }
            $this->num = $result;
        }
    }

public function getResult() {
    return $this->num;
}
}
$calculator = new Calculator();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$calculator->handleInput($_POST);
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculator</title>
</head>
<body>
    <div class="calc">
        <form action="" method="post">
            <input type="text" class="mainInput" name="input" value="<?php echo @$calculator->getResult()?>"><br>
            <input type="submit" class="numBtn" name="num" value="7">
            <input type="submit" class="numBtn" name="num" value="8">
            <input type="submit" class="numBtn" name="num" value="9">
            <input type="submit" class="calBtn" name="op" value="+"><br>
            
            <input type="submit" class="numBtn" name="num"value="4">
            <input type="submit" class="numBtn" name="num"value="5">
            <input type="submit" class="numBtn" name="num"value="6">
            <input type="submit" class="calBtn" name="op"value="-"><br>

            <input type="submit" class="numBtn" name="num"value="1">
            <input type="submit" class="numBtn" name="num"value="2">
            <input type="submit" class="numBtn" name="num"value="3">
            <input type="submit" class="calBtn" name="op"value="*"><br>

            <input type="submit" id="del" class="numBtn" name="c"value="C">
            <input type="submit" class="numBtn" name="num"value="0">
            <input type="submit" class="numBtn" name="op"value="/">
            <input type="submit" class="numBtn" name="equal"value="="><br>

            <input type="submit" id="sig" class="numBtn" name="num"value=".">
            <input type="submit" id="sig" class="numBtn" name="num"value="-">

        </form>
    </div>
</body>
</html>