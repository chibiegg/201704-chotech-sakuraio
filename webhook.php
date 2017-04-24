<?php

include('./config.php');

$json_string = file_get_contents('php://input');
$message = json_decode($json_string, TRUE);

if($message["type"] == "channels"){

  $pdo_string = sprintf('mysql:dbname=%s;host=%s;charset=utf8', DB_NAME, DB_HOST);
  $dbh = new PDO($pdo_string, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $module = $message["module"];

  foreach ($message["payload"]["channels"] as $data) {
    $datetime = $data["datetime"];
    $channel = $data["channel"];
    $value = $data["value"];

    $stmt = $dbh->prepare("INSERT INTO channels (`datetime`, `module`, `channel`, `value`) VALUES (:dt, :module, :channel, :value)");
    $stmt->bindValue(':dt', $datetime, PDO::PARAM_STR);
    $stmt->bindValue(':module', $module, PDO::PARAM_STR);
    $stmt->bindValue(':channel', $channel, PDO::PARAM_INT);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);

    try {
      $stmt->execute();
    }catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}

echo "OK";
