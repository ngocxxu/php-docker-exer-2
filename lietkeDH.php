<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liet ke don hang</title>
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
  <h1>Trang liet ke don hang</h1>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Ma don hang</th>
        <th>Ten don hang</th>
        <th>Chuc nang</th>
      </tr>
    </thead>

    <tbody>
      <?php

      $sql = "SELECT * FROM DONHANG";
      $query = mysqli_query($con, $sql);
      $stt = 1;

      if (mysqli_num_rows($query) > 0) {
        foreach ($query as $item) {
      ?>
          <tr data-madh="<?= $item['MADH']; ?>">
            <td><?= $stt++; ?></td>
            <td><?= $item['MADH']; ?></td>
            <td><?= $item['TENDH']; ?></td>
            <td>
              <button type="submit" id="delete">Xoa</button>
            </td>
          </tr>
      <?php
        }
      }

      ?>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $("tbody").on("click", "#delete", function() {
        const row = $(this).closest('tr');
        const madh = row.data('madh');

        $.ajax({
          url: "code.php",
          type: "POST",
          data: {
            _method: "DELETE",
            madh: madh
          },
          success: function(data, status) {
            row.remove();
            alert("Xóa thành công");
          },
        })
      });

    });
  </script>
</body>
</html>