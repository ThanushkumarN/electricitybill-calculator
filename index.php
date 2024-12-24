<?php
$rate = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['units'])) {
    $units = intval($_POST['units']);
    $rate = 0;

    if ($units <= 50) {
        $rate = $units * 3.5;
    } else if ($units <= 150) {
        $rate = 50 * 3.5 + ($units - 50) * 4;
    } else if ($units <= 250) {
        $rate = 50 * 3.5 + 100 * 4 + ($units - 150) * 5.2;
    } else {
        $rate = 50 * 3.5 + 100 * 4 + 100 * 5.2 + ($units - 250) * 6.5;
    }

    $rate = "Total Bill: Rs. " . number_format($rate, 2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #00c6ff, #0072ff);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            color: #333;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            font-weight: 400;
            margin-bottom: 5px;
            display: block;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: linear-gradient(120deg, #00c6ff, #0072ff);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(120deg, #0072ff, #00c6ff);
            transform: scale(1.02);
        }

        #result {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: #0072ff;
        }

        @media (max-width: 500px) {
            .container {
                padding: 15px 20px;
            }

            input[type="submit"],
            input[type="number"] {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Electricity Bill Calculator</h2>
        <form id="billForm" method="post" action="">
            <label for="units">Enter number of units:</label>
            <input type="number" id="units" name="units" required>
            <input type="submit" id="calculate" value="Calculate Bill">
        </form>
        <div id="result">
            <?php if (!empty($rate)) echo $rate; ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#billForm').submit(function (event) {
                var units = parseInt($('#units').val());
                if (units <= 0 || isNaN(units)) {
                    alert('Please enter a valid number of units consumed.');
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>

</html>
