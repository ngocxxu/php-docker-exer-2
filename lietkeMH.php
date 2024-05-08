<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liet ke mat hang</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
</style>

<body>
  <h1>Liet ke mat hang</h1>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Ten mat hang</th>
        <th>So luong ban</th>
      </tr>
    </thead>

    <tbody>
      <?php

      $sql = "SELECT HH.TENHH, CT.SOLUONG, SUM(CT.SOLUONG) AS SOLUONGBAN
              FROM HANGHOA HH
              JOIN CHITIETDONHANG CT ON HH.MAHH = CT.MAHH
              GROUP BY HH.TENHH, CT.SOLUONG
              ORDER BY SOLUONGBAN DESC
              ";

      $query = mysqli_query($con, $sql);
      $stt = 1;

      if (mysqli_num_rows($query) > 0) {
        foreach ($query as $item) {
      ?>
          <tr>
            <td><?= $stt++; ?></td>
            <td><?= $item['TENHH']; ?></td>
            <td><?= $item['SOLUONGBAN']; ?></td>
          </tr>
      <?php
        }
      }

      ?>
    </tbody>
  </table>
</body>

</html>