<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = isset($_GET['country']) ? $_GET['country'] : ''; // Get the country from the query parameter
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : ''; // Get the lookup query parameter

if ($lookup === 'cities') {
  $stmt = $conn->query("SELECT c.name as city, c.district, c.population, cs.name as country FROM cities c JOIN countries cs ON c.country_code = cs.code WHERE cs.name LIKE '%$country%'"); //Retrieve countries with name 'like' the query country

} else {
  $stmt = $conn->query("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE '%$country%'"); //Retrieve countries with name 'like' the query country
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
    <tr>
      <?php if ($lookup === 'cities'): ?>
        <th>City</th>
        <th>District</th>
        <th>Population</th>
      <?php else: ?>
        <th>Country</th>
        <th>Continent</th>
        <th>Independence Year</th>
        <th>Head of State</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <?php if ($lookup === 'cities'): ?>
          <td><?= $row['city']; ?></td>
          <td><?= $row['district']; ?></td>
          <td><?= $row['population']; ?></td>
        <?php else: ?>
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

