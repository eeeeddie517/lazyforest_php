<!doctype html>
<html lang="en">

<head>
  <title>Brand Edit</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <?php include("../js.php") ?>

  <script>
        $(document).ready(function() {
            $('#editButton').click(function() {
                $('#sidebar').addClass('open');
            });
            
            $('#closeButton').click(function() {
                $('#sidebar').removeClass('open');
            });
            
            $('#submitButton').click(function() {
                // 获取表单数据并提交到服务器
                var formData = $('#editForm').serialize();
                $.ajax({
                    url: 'update.php', // 将数据提交到 update.php 处理
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // 处理服务器返回的响应
                        alert(response);
                        $('#sidebar').removeClass('open');
                    }
                });
            });
        });
    </script>
</body>

</html>