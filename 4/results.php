<?php

require_once("simple_html_dom.php");

$teamName = $_POST["team"];
$html = file_get_html('https://terrikon.com/football/italy/championship/archive');

$result = "<p>Имя команды: " . $teamName . "</p><table border='1'><tr><td>Сезон</td><td>Место</td></tr>";

// Заходим в архив каждого сезона
foreach ($html->find('div.tab a') as $element){
    $season = substr($element->plaintext, 0, 7);
    $seasonResult = file_get_html("https://terrikon.com" . $element->href);

    // Ищем в каждом сезоне нужную команду
    foreach ($seasonResult->find('div.tab tr') as $str) {
        if(strpos($str->plaintext, $teamName)){
            $place =  $str->children(0)->plaintext[0];

            $result .= "<tr><td>" . $season . "</td><td>" . $place . "</td></tr>";
            break;
        }

    }
}

$result .= "</table>";

echo $result;
