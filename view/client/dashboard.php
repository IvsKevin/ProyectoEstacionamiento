<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include_once "navbar.php";
    include_once(__DIR__ . "/../../data/class/dashboard.php");

    if (isset($_SESSION['client_id'])) {
        $client_id = $_SESSION['client_id'];

        $dashboard = new Dashboard();

        $parkings_result = $dashboard->getParkings($client_id);
        $total_parkings_result = $dashboard->countParkings($client_id);
        $total_available_parkings_result = $dashboard->countAvailableParkings($client_id);
        $cars_result = $dashboard->getCars($client_id);
        $total_cars_result = $dashboard->countCars($client_id);
        $total_checkinout_result = $dashboard->countCheckInOutByClient($client_id);

        $parkings = $parkings_result->fetch_all(MYSQLI_ASSOC);
        $total_parkings_data = $total_parkings_result->fetch_object();
        $total_available_parkings_data = $total_available_parkings_result->fetch_object();
        $cars = $cars_result->fetch_all(MYSQLI_ASSOC);
        $total_cars_data = $total_cars_result->fetch_object();
        $total_checkinout_data = $total_checkinout_result;

        $total_employees = $dashboard->countEmployees($client_id);
        $total_cards = $dashboard->countActiveAccessCards($client_id);
        $total_visitors = $dashboard->countVisits($client_id);

        // Obtener los datos de la cantidad de carros por modelo
        $countCarsByModelResult = $dashboard->countCarsByModel($client_id);

        // Inicializar arrays para almacenar los nombres de los modelos y la cantidad de carros por modelo
        $modelNames = [];
        $totalCarsByModel = [];

        // Iterar sobre los resultados y almacenar los datos en los arrays
        while ($row = $countCarsByModelResult->fetch_assoc()) {
            $modelNames[] = $row['model_name'];
            $totalCarsByModel[] = $row['total_cars'];
        }
    } else {
        echo "La sesión no está iniciada o el cliente no está identificado.";
    }
    ?>

    <div class="main-content mt-navbarClient">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
                <div class="overflow-x-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php if (!empty($parkings)) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Parkings</h2>
                                <canvas id="parkingsChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                        <?php if ($total_employees > 0) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Empleados</h2>
                                <canvas id="employeesChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                        <?php if ($total_cards > 0) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Tarjetas</h2>
                                <canvas id="cardsChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                        <?php if ($total_visitors > 0) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Visitantes</h2>
                                <canvas id="visitorsChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                        <?php if ($total_checkinout_data->total_checkinout > 0) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Check-In/Out</h2>
                                <canvas id="checkinoutChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($modelNames)) : ?>
                            <div class="bg-gris-oscurito p-4 rounded shadow">
                                <h2 class="text-lg font-semibold mb-2">Modelos de Carros</h2>
                                <canvas id="carsByModelChart" width="800" height="650"></canvas>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configurar datos para el gráfico de parkings
        <?php if (!empty($parkings)) : ?>
            var totalParkings = <?php echo $total_parkings_data->total_parkings; ?>;
            var availableParkings = <?php echo $total_available_parkings_data->available_parkings; ?>;
            var ctxParkings = document.getElementById('parkingsChart').getContext('2d');
            var parkingsChart = new Chart(ctxParkings, {
                type: 'bar',
                data: {
                    labels: ['Parkings (<?php echo $total_parkings_data->total_parkings; ?>)        Disponibles (<?php echo $total_available_parkings_data->available_parkings; ?>)'],
                    datasets: [{
                            label: 'Parkings',
                            data: [totalParkings],
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Disponibles',
                            data: [availableParkings],
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php endif; ?>

        // Configurar datos para el gráfico de empleados
        <?php if ($total_employees > 0) : ?>
            var totalEmployees = <?php echo $total_employees; ?>;
            var ctxEmployees = document.getElementById('employeesChart').getContext('2d');
            var employeesChart = new Chart(ctxEmployees, {
                type: 'bar',
                data: {
                    labels: ['Total (<?php echo $total_employees; ?>)'],
                    datasets: [{
                        label: 'Empleados',
                        data: [totalEmployees],
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
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
        <?php endif; ?>

        // Configurar datos para el gráfico de tarjetas
        <?php if ($total_cards > 0) : ?>
            var totalCards = <?php echo $total_cards; ?>;
            var ctxCards = document.getElementById('cardsChart').getContext('2d');
            var cardsChart = new Chart(ctxCards, {
                type: 'bar',
                data: {
                    labels: ['Total (<?php echo $total_cards; ?>)'],
                    datasets: [{
                        label: 'Tarjetas',
                        data: [totalCards],
                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                        borderColor: 'rgba(255, 206, 86, 1)',
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
        <?php endif; ?>

        // Configurar datos para el gráfico de visitantes
        <?php if ($total_visitors > 0) : ?>
            var totalVisitors = <?php echo $total_visitors; ?>;
            var ctxVisitors = document.getElementById('visitorsChart').getContext('2d');
            var visitorsChart = new Chart(ctxVisitors, {
                type: 'bar',
                data: {
                    labels: ['Total (<?php echo $total_visitors; ?>)'],
                    datasets: [{
                        label: 'Visitantes',
                        data: [totalVisitors],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        <?php endif; ?>

        // Configurar datos para el gráfico de check-in/out
        <?php if ($total_checkinout_data->total_checkinout > 0) : ?>
            var totalCheckInOut = <?php echo $total_checkinout_data->total_checkinout; ?>;
            var totalCheckInOutWithDate = <?php echo $total_checkinout_data->total_with_date; ?>;
            var totalCheckInOutWithoutDate = <?php echo $total_checkinout_data->total_without_date; ?>;
            var ctxCheckInOut = document.getElementById('checkinoutChart').getContext('2d');
            var checkInOutChart = new Chart(ctxCheckInOut, {
                type: 'bar',
                data: {
                    labels: ['Total (<?php echo $total_checkinout_data->total_checkinout; ?>)', 'Completas (<?php echo $total_checkinout_data->total_with_date; ?>)', 'Sin salida (<?php echo $total_checkinout_data->total_without_date; ?>)'],
                    datasets: [{
                            label: 'Entradas y Salidas',
                            data: [totalCheckInOut, '', ''],
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Completas',
                            data: ['', totalCheckInOutWithDate, ''],
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Sin salida',
                            data: ['', '', totalCheckInOutWithoutDate],
                            backgroundColor: 'rgba(255, 206, 86, 0.6)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0
                        },
                        x: {
                            stacked: true
                        }
                    }
                }
            });
        <?php endif; ?>

        // Configurar datos para el gráfico de modelos de carros
        <?php if (!empty($modelNames)) : ?>
            var modelNames = <?php 
    $modelNamesWithCount = [];
    foreach ($modelNames as $index => $modelName) {
        $modelNamesWithCount[] = $modelName . ' (' . $totalCarsByModel[$index] . ')';
    }
    echo json_encode($modelNamesWithCount); ?>;

            var totalCarsByModel = <?php echo json_encode($totalCarsByModel); ?>;
            var ctxCarsByModel = document.getElementById('carsByModelChart').getContext('2d');
            var carsByModelChart = new Chart(ctxCarsByModel, {
                type: 'bar',
                data: {
                    labels: modelNames,
                    datasets: [{
                        label: 'Cantidad de Carros',
                        data: totalCarsByModel,
                        backgroundColor: generateRandomColorArray(modelNames.length),
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        <?php endif; ?>

        // Función para generar un array de colores aleatorios
        function generateRandomColorArray(numColors) {
            var colors = [];
            for (var i = 0; i < numColors; i++) {
                var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.6)';
                colors.push(randomColor);
            }
            return colors;
        }
    </script>
</body>

</html>
