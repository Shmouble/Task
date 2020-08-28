<?php

$colors = ["red", "blue", "green", "yellow", "lime", "magenta", "black", "gold", "gray", "tomato"];
$finalTest = "";
$word = "";
$color = "";
$line = "";

for($i = 0; $i < 5; $i++){
    $line = "<p>";
    for($j = 0; $j < 5; $j++){
        // Проверяем, чтобы слово и цвет не совпадали
        do{
            $word = $colors[rand(0, count($colors) - 1)];
            $color = $colors[rand(0, count($colors) - 1)];
        } while($word == $color);

        $line .= "<span style=\"color:$color\">$word</span> ";
    }

    $line .= "</p>";
    $finalTest .= $line;
}

echo $finalTest;
