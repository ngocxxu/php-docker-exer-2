<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang liet ke khach hang</title>
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
  <h1>Trang liet ke khach hang</h1>

  <label for="tenkh">Ten khach hang:</label>
  <select name="tenkh" id="tenkh">
    <?php

    $sql = "SELECT * FROM KHACHANG";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
      foreach ($query as $item) {
    ?>
        <option value="<?= $item['TENKH']; ?>"><?= $item['TENKH']; ?></option>
    <?php
      }
    }

    ?>
  </select></br>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Ten DH</th>
      </tr>
    </thead>

    <tbody></tbody>
  </table>

  <script>
    $(document).ready(function() {
      $("#tenkh").change(function() {
        const tenkh = $(this).val();

        $.ajax({
          url: "code.php",
          type: "GET",
          data: {
            tenkh: tenkh
          },
          success: function(response) {
            const dsSP = JSON.parse(response);
            console.log(dsSP);
            const tableBody = $("tbody");
            tableBody.empty();
            for (let i = 0; i < dsSP.length; i++) {
              const sp = dsSP[i];

              const row = `
                <tr>
                  <td>${i++ + 1}</td>
                  <td>${sp.TENDH}</td>
                </tr>
                `

              tableBody.append(row);
            }
          },
        });

      });

    });
  </script>
</body>
</html>