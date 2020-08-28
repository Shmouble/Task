<?php

if($argc > 1){
    $stringToArray = explode(" ", $argv[1]);

    $numbers = [];

    foreach ($stringToArray as $element){
        // Проверяем, является ли часть строки числом (положительным или отрицательным)
        if (ctype_digit($element) || ($element[0] == "-" && ctype_digit(substr($element, 1)))) {
            $numbers[] = (int)$element;
        }
    }

    $numbers = array_unique($numbers);
    sort($numbers);

    $finalString = "";
    foreach ($numbers as $number) {
        $finalString .= $number . " ";
    }

    echo $finalString;
}
