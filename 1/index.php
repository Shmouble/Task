<?php

require_once("First.php");
require_once("Second.php");

$first = new First();
$second = new Second();

$first->getClassname();
echo "<br>";
$first->getLetter();
echo "<br>";
$second->getClassname();
echo "<br>";
$second->getLetter();
