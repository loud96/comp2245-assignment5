<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = isset($_GET['country']) ? $_GET['country'] : ''; // Get the country from the query parameter

$stmt = $conn->query("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE '%$country%'"); //Retrieve countries with name 'like' the query country
// $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'"); //Retrieve countries with name 'like' the query country

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<table>
  <thead>
    <tr>
      <th>Country</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['continent']; ?></td>
        <td><?= $row['independence_year']; ?></td>
        <td><?= $row['head_of_state']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

