<?php
/**
 * @author Peskov Sergey
 * @date 2018
 * Русская рулетка
 *
 */


/**
 * @param int $key
 * @param array $variants
 * @return mixed|string
 */
function drawVariant($key, $variants)
{
    switch ($key){
        case 1: $str = $variants[$key]; break;
        default: $str = "<i class=\"{$variants[$key]}\"></i>"; break;
    }

    return $str;
}

/**
 * @param int $key
 * @return string
 */
function drawWinning($key)
{

    $winnings = [
        0 => 0,
        1 => 10,
        2 => 100,
        3 => 1000,
        4 => 10000,
        5 => 1000000
    ];

    return number_format($winnings[$key], 0, '.', ' ') . ' руб';
}

/**
 * @param $spin1
 * @param $spin2
 * @param $spin3
 *
 * @return string
 */
function eveluateWinning($spin1, $spin2, $spin3)
{

    if($spin1 == 1 && $spin2 == 1 && $spin3 == 1){
        return drawWinning(5); // Выпало 777 Самый максимальный выигрыш
    }

    if($spin1 == $spin2 && $spin2 == $spin3){
        return drawWinning(4); // Совпало все
    }

    if($spin1 == 1 && $spin2 == 1 || $spin2 == 1 && $spin3 == 1 || $spin1 == 1 && $spin3 == 1){
        return drawWinning(3); // Выпала две 7.
    }


    if($spin1 == $spin2 || $spin2 == $spin3 || $spin1 == $spin3){
        return drawWinning(2); // Одно совпадение
    }
    if($spin1 == 1 || $spin2 == 1 || $spin3 == 1 ){
        return drawWinning(1); // Выпала одна 7.
    }

    return drawWinning(0); //Ничего из условий выиграша не совпало
}

/**
 * @return array
 */
function startSpin()
{

    $variants = [
        1 => "7",
        2 => "fas fa-dollar-sign",
        3 => "fas fa-euro-sign",
        4 => "fas fa-ruble-sign",
        5 => "fas fa-star",
        6 => "fas fa-chess-knight",
        7 => "fab fa-apple"
    ];

    $min = 1;
    $max = count($variants);

    $spin1 = rand($min, $max);
    $spin2 = rand($min, $max);
    $spin3 = rand($min, $max);

    return [
        'variant1' => drawVariant($spin1, $variants),
        'variant2' => drawVariant($spin2, $variants),
        'variant3' => drawVariant($spin3, $variants),
        'result' => eveluateWinning($spin1, $spin2, $spin3)
    ];
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <title></title>
</head>
<body>
<?php
    if(isset($_GET['spin']) && $_GET['spin'] == 1){

        $spinResult = startSpin();

        echo $spinResult['variant1'] . "\n";
        echo $spinResult['variant2'] . "\n";
        echo $spinResult['variant3'] . "\n";

        echo "<h1>Выигрыш: {$spinResult['result']}</h1>";

    }
?>
<div>
    <a href="?spin=1">Вращать</a>
</div>

</body>
</html>
