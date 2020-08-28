<?php

$hostName = "127.0.0.1";
$userName = "root";
$password = "";
$dbName = "testbase";

$connection = new mysqli($hostName, $userName, $password, $dbName);

if ($connection->connect_error) {
    echo "Не удалось установить соединение: " . $connection->connect_error;
    die();
}

$query = "SELECT id, fullname, city_id FROM persons";
$personsResult = $connection->query($query);
$persons = [];

if ($personsResult->num_rows > 0) {
    while($row = $personsResult->fetch_assoc()) {
        $persons[$row["id"]] = [
            "fullname" => $row["fullname"],
            "cityId" => $row["city_id"],
            "balance" => 100
        ];
    }
} else {
    echo "Никого";
    die();
}

$query = "SELECT  transaction_id, from_person_id, to_person_id, amount FROM transactions";
$transactionsResult = $connection->query($query);
$transactions = [];
if ($transactionsResult->num_rows > 0) {
    // Высчитываем баланс после всех транзакций
    while($row = $transactionsResult->fetch_assoc()) {
        $transactions[$row["transaction_id"]] = [
            "fromPersonId" => $row["from_person_id"],
            "toPersonId" => $row["to_person_id"],
            "amount" => $row["amount"]
        ];

        $persons[$row["from_person_id"]]["balance"] -= (int)$row["amount"];
        $persons[$row["to_person_id"]]["balance"] += (int)$row["amount"];
    }

    // Вывод итогового баланса
    $balances = "<table border='1'><tr><td>Имя</td><td>Баланс</td></tr>";
    foreach ($persons as $k => $person){
        //print_r($person);
        $name = $person["fullname"];
        $balance = $person["balance"];
        $balances .= "<tr><td>$name</td><td>$balance</td></tr>";
    }
    $balances .= "</table>";

    echo $balances;
    echo "<br>";
} else {
    echo "Никаких тразакций";
    die();
}

$query = "SELECT id, name FROM cities";
$citiesResult = $connection->query($query);
$cities = [];

if ($citiesResult->num_rows > 0) {
    while($row = $citiesResult->fetch_assoc()) {
        $cities[$row["id"]] = [
            "name" => $row["name"],
            "transactionsAmount" => 0
        ];
    }

    // Проверяем, в каком городе жители сделали наибольшее количество транзакций
    foreach ($transactions as $k => $transaction){
        $cities[$persons[$transaction["fromPersonId"]]["cityId"]]['transactionsAmount'] += 1;
        $cities[$persons[$transaction["toPersonId"]]["cityId"]]['transactionsAmount'] += 1;
    }

    $maxName = "";
    $maxTransactions = 0;
    foreach ($cities as $k => $city){
        if($city["transactionsAmount"] > $maxTransactions){
            $maxTransactions = $city["transactionsAmount"];
            $maxName = $city["name"];
        }
    }

    echo "Город, где жители произвели наибольшее количество транзакций: " . $maxName . ". Количество транзакций: " . $maxTransactions;
} else {
    echo "Никаких городов";
    die();
}

echo "<br>";
echo "Транзакции между жителями одного города: ";
$sameCityTr = "<table border='1'>
                <tr>
                    <td>Номер транзакции</td>
                    <td>from_person_id</td>
                    <td>to_person_id</td>
                    <td>amount</td>
                </tr>";

foreach ($transactions as $k => $transaction){
    // Ищем транзакции между жителями одного города
    if($persons[$transaction['fromPersonId']]['cityId'] == $persons[$transaction['toPersonId']]['cityId']){
        $fromPerson = $transaction['fromPersonId'];
        $toPerson = $transaction['toPersonId'];
        $amount = $transaction['amount'];
        $sameCityTr .= "<tr>
                            <td>" . $k . "</td>
                            <td>$fromPerson</td>
                            <td>$toPerson</td>
                            <td>$amount</td>
                        </tr>";
    }
}

echo $sameCityTr;

$connection->close();
