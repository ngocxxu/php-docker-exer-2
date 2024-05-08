<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liet ke don hang theo ngay</title>
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
  <h1>Trang liet ke don hang theo ngay</h1>

  <label for="ngaydat">Ngay: </label>
  <input type='date' name="ngaydat" id="ngaydat" /></br>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Ma DH</th>
        <th>Ten KH</th>
      </tr>
    </thead>

    <tbody></tbody>
  </table>

  <script>
    $(document).ready(function() {
      $("#ngaydat").change(function() {
        const ngaydat = $(this).val();

        $.ajax({
          url: "code.php",
          type: "GET",
          data: {
            ngaydat: ngaydat
          },
          success: function(response) {
            const dsSP = JSON.parse(response);
            const tableBody = $("tbody");
            tableBody.empty();

            for (let i = 0; i < dsSP.length; i++) {
              const sp = dsSP[i];

              const row = `
                <tr>
                  <td>${i++ + 1}</td>
                  <td>${sp.MADH}</td>
                  <td>${sp.TENKH}</td>
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