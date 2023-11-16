<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = isset($_GET['country']) ? $_GET['country'] : ''; // Get the country from the query parameter

$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'"); //Retrieve countries with name 'like' the query country

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
