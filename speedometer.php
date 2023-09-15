<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="speedometer.css">
    <title>speedometer</title>
</head>

<body>

    <!-- PHP script to get data from database -->
    <?php

    $servername = "localhost";
    $port = 3306;
    $username = "root";
    $password = "";
    $database = "ky040_db";

    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM ky040 LIMIT 20"; // Change to your table name
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die("Query failed: " . $conn->error);
    }
    $data = array();
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the rows and fetch data
        while ($row = $result->fetch_assoc()) {
            // Access the columns by name
            $data[] = $row;
        }
    } else {
        echo "No results found.";
    }

    // Close the database connection
    $json_data = json_encode($data);
    echo "<script>var chartData= $json_data;</script>";
    $conn->close();
    ?>


    <div class="speedometer">
        <!-- value screen  -->
        <div class="speed-value">
            <div class="static"></div>
            <div class="dynamic">
                <span class="num">0</span>
                <span class="unit">&deg;</span>
            </div>
            <div>
                <p>Angular speed</p>
            </div>
        </div>

        <!-- center point where needle attached -->
        <div class="center-point">

        </div>
        <!-- center to hide dialing pointers -->
        <div class="speedometer-center-hide"></div>
        <div class="arrow-container">
            <!-- arrow pointer -->
            <div class="arrow-wrapper speed-0" id="arrow">
                <div class="arrow"></div>
            </div>
        </div>

        <!-- dialing pointers -->
        <div class="speedometer-scale speedometer-scale-1"></div>
        <!-- <div class="speedometer-scale speedometer-scale-2"></div> -->
        <div class="speedometer-scale speedometer-scale-3"></div>
        <div class="speedometer-scale speedometer-scale-4"></div>
        <div class="speedometer-scale speedometer-scale-5"></div>
        <div class="speedometer-scale speedometer-scale-6"></div>
        <div class="speedometer-scale speedometer-scale-7"></div>
        <div class="speedometer-scale speedometer-scale-8"></div>
        <div class="speedometer-scale speedometer-scale-9"></div>
        <div class="speedometer-scale speedometer-scale-10"></div>
        <div class="speedometer-scale speedometer-scale-11"></div>
        <div class="speedometer-scale speedometer-scale-12"></div>
        <div class="speedometer-scale speedometer-scale-13"></div>
        <div class="speedometer-scale speedometer-scale-14"></div>
        <div class="speedometer-scale speedometer-scale-15"></div>
        <div class="speedometer-scale speedometer-scale-16"></div>
        <div class="speedometer-scale speedometer-scale-17"></div>
        <!-- <div class="speedometer-scale speedometer-scale-18"></div> -->
        <div class="speedometer-scale speedometer-scale-19"></div>
        <div class="speedometer-scale speedometer-scale-20"></div>
        <!-- <div class="speedometer-scale speedometer-scale-21"></div> -->
        <div class="speedometer-scale speedometer-scale-22"></div>
        <div class="speedometer-scale speedometer-scale-23"></div>
        <div class="speedometer-scale speedometer-scale-24"></div>
        <div class="speedometer-scale speedometer-scale-25"></div>
        <div class="speedometer-scale speedometer-scale-26"></div>
        <div class="speedometer-scale speedometer-scale-27"></div>
        <div class="speedometer-scale speedometer-scale-28"></div>
        <div class="speedometer-scale speedometer-scale-29"></div>
        <div class="speedometer-scale speedometer-scale-30"></div>
        <div class="speedometer-scale speedometer-scale-31"></div>
        <div class="speedometer-scale speedometer-scale-32"></div>
        <div class="speedometer-scale speedometer-scale-33"></div>
    </div>
    <script>
        var speed = 0;
        var prevSpeed = 0;
        var currentScale = 1;
        var prev_data = [];
        var arrow = document.getElementById('arrow');
        function updateDashboard() {
            fetch('fetch_data.php')
                .then(response => response.json())
                .then(chartData => {
                    // console.log(chartData);
                    if (prev_data.length !== chartData.sensorValue.length) {
                        prev_data = chartData.sensorValue;
                        var data = chartData.sensorValue;
                        let data_2 = chartData; // chartdata that is getting from php and parsed
                        // getting values of angular speed
                        var values = data.map(function (item) {
                            return item.angular_speed; // Replace "value" with the actual property name in your data
                        });
                        // Function to remove transition after it ends
                        function removeTransition() {
                            arrow.style.transition = '';
                            el.removeEventListener('transitionend', removeTransition);
                        }
                        // function to update needle pointer for speed
                        function addClass(speed) {
                            var newSpeed = speed;
                            if (true) {
                                console.log(speed);
                                // arrow.style.transition = 'transform 0.02s';
                                arrow.style.transform = 'rotate(' + speed + 'deg)';
                                let newClass = 'speed-' + speed;
                                let prevClass = 'speed-' + prevSpeed;
                                let el = document.getElementsByClassName('arrow-wrapper')[0]
                                if (el.classList.contains(prevClass)) {
                                    el.classList.remove(prevClass)
                                    el.classList.add(newClass)
                                }
                                prevSpeed = speed
                                // setTimeout(function() { 
                                //     arrow.style.transition = '';
                                // }, 10)
                            }
                            else if (Math.abs(prevSpeed) === 348 && speed === 0) {
                                arrow.style.transform = 'rotate(' + speed + 'deg)';
                                let newClass = 'speed-' + speed;
                                let prevClass = 'speed-' + prevSpeed;
                                let el = document.getElementsByClassName('arrow-wrapper')[0]
                                if (el.classList.contains(prevClass)) {
                                    el.classList.remove(prevClass)
                                    el.classList.add(newClass)
                                }
                                prevSpeed = speed
                            }
                            else if (Math.abs(prevSpeed) === 0 && speed === 348) {
                                arrow.style.transform = 'rotate(' + speed + 'deg)';
                                let newClass = 'speed-' + speed;
                                let prevClass = 'speed-' + prevSpeed;
                                let el = document.getElementsByClassName('arrow-wrapper')[0]
                                if (el.classList.contains(prevClass)) {
                                    el.classList.remove(prevClass)
                                    el.classList.add(newClass)
                                }
                                prevSpeed = speed
                            }
                            // else {

                            // }
                            // console.log(speed);
                            // arrow.style.transform = 'rotate(' + speed + 'deg)';
                            // let newClass = 'speed-' + speed;
                            // let prevClass = 'speed-' + prevSpeed;
                            // let el = document.getElementsByClassName('arrow-wrapper')[0]
                            // if (el.classList.contains(prevClass)) {
                            //     el.classList.remove(prevClass)
                            //     el.classList.add(newClass)
                            // }
                            // prevSpeed = speed
                        }

                        // display of text 
                        function changeText(speed) {
                            let el = document.getElementsByClassName('num')[0]
                            el.innerText = speed;
                        }

                        // showing last value
                        addClass(values[values.length - 1]);
                        changeText(values[values.length - 1]);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        updateDashboard();
        setInterval(updateDashboard, 500);
    </script>
</body>

</html>