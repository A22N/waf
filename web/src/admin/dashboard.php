<?php
session_start();
include_once("./inc/side-nav.php");
include_once('../DB_Config/connectDB.php');
include_once('./func/dashboard.php');
if (isset($_SESSION["User"]) && $_SESSION["Role"] === "Admin") {

    $arrJSON = GetPostJson($conn);
    $arr1JSON = GetPostJson1($conn);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>ADMIN Panel</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 card">
                    <div class="card-header">
                        Tỉ lệ duyệt bài
                    </div>
                    <canvas id="Bieudo1"></canvas>
                </div>
                <div class="col-6 card">
                    <div class="card-header">
                        Số lượng bài viết theo thể loại
                    </div>
                    <canvas id="Bieudo2"></canvas>
                </div>
            </div>
        </div>
        <script>
            var arr = <?= $arrJSON ?>;
            console.log(arr);
            var label = [];
            var amount = [];
            for (let i = 0; i < arr.length; i++) {
                label.push(arr[i].Status_Name)
                amount.push(arr[i].total)
            }
            const ctx = document.getElementById('Bieudo1');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Số lượng',
                        data: amount,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            var arr1 = <?= $arr1JSON ?>;
            console.log(arr1);
            var label1 = [];
            var amount1 = [];
            for (let i = 0; i < arr1.length; i++) {
                label1.push(arr1[i].Category_Name)
                amount1.push(arr1[i].total)
            }
            const ctx1 = document.getElementById('Bieudo2');

            new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: label1,
                    datasets: [{
                        label: 'Số lượng',
                        data: amount1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        </section>
        </div>
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>