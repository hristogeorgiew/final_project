<?php
    include './includes/app.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hristo Georgiev - Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="container">
        <!-- Header -->
        <?php include './includes/header.php'; ?>
        <!--End Header -->

        <!-- Forms -->
        <form action="index.php" method="GET">
            <div class="labelName">
                <p><label for="hours">Въведете час:</label></p>
                <p><label for="minutes">Въведете минути:</label></p>
                <p><label for="seconds">Въведете секунди:</label></p>
                <p><label for="angle">Въведете ъгъл:</label></p>
            </div>
            <div class="inputs">
                <p><input placeholder="12" id="hours" type="text" name="hours"></p>
                <p><input placeholder="00" id="minutes" type="text" name="minutes"></p>
                <p><input placeholder="00" id="seconds" type="text" name="seconds"></p>
                <p><input placeholder="1" id="angle" type="text" name="angle"></p>
            </div>
            <div class="btnDiv">
                <button class="btn" type="submit">Изчисли</button>
            </div>
        </form>

        <!--End Forms -->

        <?php 
            if(isset($_GET['hours'])) {
                $hours = trim($_GET['hours']);
                $minutes = trim($_GET['minutes']);
                $seconds = trim($_GET['seconds']);
                $angle = trim($_GET['angle']);
                if(validate_data($hours, $minutes, $seconds, $angle) === true) {
                    $time = date('H:i:s', strtotime($hours . ':' . $minutes . ':' . $seconds));
                    echo '<div class="result">';
                        echo '<h1>' . 'Часът е: ' . clockHandAngle2($angle, $time) . '</h1>';
                    echo '</div>';
                } else {
                    echo '<div class="warning">';
                        echo validate_data($hours, $minutes, $seconds, $angle);
                    echo '</div>';
                }
               
            } 
        ?>

        <!-- Footer -->
        <?php include './includes/footer.php'; ?>
        <!--End Footer -->
    </div>
</body>
</html>
