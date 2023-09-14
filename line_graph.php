<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .graph {
        height: 65vh;
        width: 65vw;
        padding: 5vh;
    }
</style>

<body>    
    <!-- <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <canvas id="myChart" class="graph"></canvas>
    
    
    <!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
    <script>
        // Function to fetch sensor data and update the dashboard
        var prev_data = [];
        function arraysAreEqual(arr1, arr2) {
            if (arr1.length !== arr2.length) {
                return false;
            }

            for (let i = 0; i < arr1.length; i++) {
                const obj1 = arr1[i];
                const obj2 = arr2[i];

                // Compare the objects within the arrays
                if (!objectsAreEqual(obj1, obj2)) {
                    return false;
                }
            }

            return true;
        }

        // Function to compare two objects
        function objectsAreEqual(obj1, obj2) {
            return obj1.timestamp === obj2.timestamp && obj1.angular_speed === obj2.angular_speed;
        }
        var values = []
        function updateDashboard() {
            fetch('fetch_data.php')
                .then(response => response.json())
                .then(chartData => {
                    // console.log(chartData);
                    if (prev_data.length !== chartData.sensorValue.length) {
                        prev_data = chartData.sensorValue;
                        var data = chartData.sensorValue;
                        console.log(data);

                        // Extract the data you need for your chart (e.g., labels and values)
                        var labels2 = data.map(function (item) {
                            return item.timestamp; // Replace "label" with the actual property name in your data
                        });
                        var labels3 = []
                        for (let i = 0; i < 30; i++) {
                            labels3.push(labels2[labels2.length - i]);
                        }

                        // labels2 =labels2.slice(15);

                        var values = data.map(function (item) {
                            return item.angular_speed; // Replace "value" with the actual property name in your data
                        });

                        var maxValue = Math.max(...values);

                        // Calculate the step size based on your desired interval (0.5 units)
                        var stepSize = 0.5;

                        // Calculate the number of steps required
                        var numSteps = Math.ceil(maxValue / stepSize);

                        // Create an array of step values for the y-axis ticks
                        var yTicks = Array.from({ length: numSteps + 1 }, (_, i) => i * stepSize);


                        // Create a chart using Chart.js
                        var canvas = document.getElementById('myChart');
                        if (canvas) {
                            var ctx = canvas.getContext('2d');

                            // Get the chart instance if it exists
                            var existingChart = Chart.getChart(ctx);

                            // If an existing chart is found, destroy it
                            if (existingChart) {
                                existingChart.destroy();
                            }
                        }
                        // var labels3  = labels2.slice(-20);
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels3,
                                datasets: [{
                                    label: 'timestamp to angular_speed',
                                    data: values,
                                    backgroundColor: 'rgba(255, 194, 70, 0.2)', // Area under the line
                                    borderColor: 'rgba(255, 194, 70, 1)', // Line color
                                    borderWidth: 3, // Line width
                                    fill: true, // Fill area under the line
                                    lineTension: 0.4, // Line tension for curved lines
                                    pointRadius: 5, // Radius of data points
                                    pointBackgroundColor: 'rgba(255, 194, 70, 1)', // Color of data points
                                    pointBorderColor: 'rgba(255, 194, 70, 1)', // Border color of data points
                                    pointHoverRadius: 8, // Hover radius of data points
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Angular speed',
                                            position: 'end',
                                            font: {
                                                size: 16,      // Font size
                                                family: 'Arial', // Font family
                                                weight: 'bold' // Font weight
                                            },
                                            color: 'rgb(255,194,70)'
                                        },
                                        ticks: {
                                            stepSize: stepSize,
                                            callback: function (value, index, values) {
                                                return value.toFixed(2); // Format the tick label as desired
                                            }
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Time Stamp',
                                            position: 'end',
                                            font: {
                                                size: 16,      // Font size
                                                family: 'Arial', // Font family
                                                weight: 'bold' // Font weight
                                            },
                                            color: 'rgb(255,194,70)'
                                        },
                                    }
                                }
                            }
                        });
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