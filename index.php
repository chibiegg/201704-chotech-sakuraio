<?php

include('./config.php');

$pdo_string = sprintf('mysql:dbname=%s;host=%s;charset=utf8', DB_NAME, DB_HOST);
$dbh = new PDO($pdo_string, DB_USER, DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = <<<EOT
SELECT C1.module, C1.datetime, C1.channel, C1.value
FROM channels C1
INNER JOIN (
   SELECT
     module, channel, MAX(datetime) AS datetime
   FROM
    channels GROUP BY module, channel
) AS C2
ON C2.module=C1.module AND C2.channel=C1.channel AND C2.datetime=C1.datetime
ORDER BY C1.module ASC, C1.channel ASC
EOT;

$stmt = $dbh->query($sql);

?>

<html>
<table>
  <thead>
    <tr><th>モジュール</th><th>チャンネル</th><th>値</th><th>時刻</th></tr>
  </thead>
  <tbody>
<?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr>
      <th><?php echo($result["module"]); ?></th>
      <th><?php echo($result["channel"]); ?></th>
      <td><?php echo($result["value"]); ?></td>
      <td><?php echo($result["datetime"]); ?>+0000</td>
    </tr>
<?php } ?>
  </tbody>
</table>
