<?php require_once(VIEWS_PATH . "header.php") ?>
<script>
    window.onload = function() {


        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "World Energy Consumption by Sector - 2012"
            },
            data: [{
                type: "pie",
                indexLabel: "{y}",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "#36454F",
                indexLabelFontSize: 18,
                indexLabelFontWeight: "bolder",
                showInLegend: true,
                legendText: "{label}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>

<body style="background-color: #A8B3C5;">

    <?php require_once(VIEWS_PATH . "admin-navbar.php") ?>
    <?php

    $dataPoints = array(
        array("label" => "Industrial", "y" => 51.7),
        array("label" => "Transportation", "y" => 26.6),
        array("label" => "Residential", "y" => 13.9),
        array("label" => "Commercial", "y" => 7.8)
    )

    ?>


    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



</body>

</html>