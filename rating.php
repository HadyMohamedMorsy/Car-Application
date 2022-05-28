<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
    <title>Rating</title>
</head>
<body>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Rating from 100</th>
                <th>Reason</th>
                <th>Number Of Car</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>100%</td>
                <td>Good</td>
                <td>ب د ه 42</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>60%</td>
                <td>he is Aggresive</td>
                <td>12ح ب</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>70%</td>
                <td>he is Aggresive</td>
                <td>1223</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>65%</td>
                <td>he is Aggresive</td>
                <td>1253</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>35%</td>
                <td>he is Aggresive</td>
                <td>1223ب س</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>44%</td>
                <td>he is Aggresive</td>
                <td>غ و أ</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>88%</td>
                <td>he is Aggresive</td>
                <td>3351</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>50%</td>
                <td>he is shy</td>
                <td>4351</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>hady812012@gmail.com</td>
                <td>01012315216</td>
                <td>30%</td>
                <td>he is frendly</td>
                <td>3352</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Rating from 100</th>
                <th>Reason</th>
                <th>Number Of Car</th>
            </tr>
        </tfoot>
</table>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</body>
</html>