<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENSOR</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <div class="parent-div">
        <div class="sidebar">
            <ul>
                <div class="btn-group">
                    <button type="button" class="btn  dropdown-toggle btn-first " data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Sensor
                    </button>
                    <div class="dropdown-menu">
                        <li onclick="showDialChart()">Dial</li>
                        <li onclick="showLineChart()">Line Chart</li>

                    </div>
                </div>
                <li>
                    <select id="cars">
                        <option value="Sensor1">Sensor1</option>
                        <option value="Sensor2">Sensor2</option>
                        <option value="Sensor3">Sensor3</option>
                    </select>
                </li>
            </ul>

        </div>
        <main>
            <div class="graph">
                <div id="dialChartPlaceholder" style="display: none;">
                    <!-- Include your dial chart here -->
                    <?php require_once("speedometer.php"); ?>
                </div>
                <div id="lineChartPlaceholder" style="display: none;">
                    <!-- Include your line chart here -->
                    <?php require_once("line_graph3.php"); ?>
                </div>

                <div class="row" style='justify-content:center'>
                    <button type="button" class="btn btn-1">Start</button>

                    <button type="button" class="btn btn-1">Refresh</button>

                    <button type="button" class="btn btn-1">Pause</button>

                </div>
            </div>
        </main>
    </div>

    <script>
        function showDialChart() {
            document.getElementById('dialChartPlaceholder').style.display = 'block';
            document.getElementById('lineChartPlaceholder').style.display = 'none';
        }

        function showLineChart() {
            document.getElementById('dialChartPlaceholder').style.display = 'none';
            document.getElementById('lineChartPlaceholder').style.display = 'block';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>