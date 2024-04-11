<?php include_once "navbar.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-content mt-navbarAdmin">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <!-- Aquí puedes agregar contenido adicional del navbar si es necesario -->
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <!-- Contenido del dashboard -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gris-oscurito p-4 rounded shadow-lg">
                            <canvas class="chart w-full h-64" id="membershipChart"></canvas>
                        </div>
                        <div class="bg-gris-oscurito p-4 rounded shadow-lg">
                            <canvas class="chart w-full h-64" id="clientChart"></canvas>
                        </div>
                        <div class="bg-gris-oscurito p-4 rounded shadow-lg" style="height: 400px;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        <?php
        // Importamos las clases de Client y Payment
        include_once(__DIR__ . "/../../data/class/client.php");
        include_once(__DIR__ . "/../../data/class/payment.php");

        // Creamos instancias de las clases
        $client = new Client();
        $payment = new Payment();

        // Obtenemos los datos para las gráficas
        $basicCount = $payment->sumBasicPayment();
        $proCount = $payment->sumProPayment();
        $regularCount = $payment->sumRegularPayment();

        // Obtenemos el total de clientes
        $totalClients = $client->countTotalClients();

        // Obtenemos los datos de ganancias por mes
        $earningsByMonth = $payment->getEarningsByMonth();

        // Obtenemos las ganancias totales
        $totalEarnings = $payment->sumPayment();
        ?>

        // Datos para la gráfica de membresías
        var membershipData = {
            labels: ['Básica (<?php echo $basicCount; ?>)', 'Pro (<?php echo $proCount; ?>)', 'Regular (<?php echo $regularCount; ?>)'],
            datasets: [{
                data: [<?php echo $basicCount; ?>, <?php echo $proCount; ?>, <?php echo $regularCount; ?>],
                backgroundColor: ['#4CAF50', '#2196F3', '#FF5722']
            }]
        };

        // Datos para la gráfica de clientes
        var clientData = {
            labels: ['Clientes nuevos (<?php echo $totalClients; ?>)'],
            datasets: [{
                data: [<?php echo $totalClients; ?>, 0], // Usamos el total de clientes como primer dato
                backgroundColor: ['#FF9800']
            }]
        };

        // Datos para la gráfica de ingresos
        var revenueData = {
            labels: [<?php foreach ($earningsByMonth as $earnings) {
                            echo "'" . $earnings['month'] . "/" . $earnings['year'] . "', ";
                        } ?>],
            datasets: [{
                label: 'Ganancias totales (<?php echo $totalEarnings; ?>)',
                data: [<?php foreach ($earningsByMonth as $earnings) {
                            echo $earnings['total_earnings'] . ", ";
                        } ?>],
                backgroundColor: '#2196F3'
            }]
        };

        // Creación de las gráficas
        var membershipChart = new Chart(document.getElementById('membershipChart').getContext('2d'), {
            type: 'pie',
            data: membershipData
        });

        var clientChart = new Chart(document.getElementById('clientChart').getContext('2d'), {
            type: 'doughnut',
            data: clientData
        });

        var revenueChart = new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'line',
            data: revenueData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14 // Tamaño de la fuente del eje X
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 14 // Tamaño de la fuente del eje Y
                            },
                            callback: function(value, index, values) {
                                return '$' + value; // Prefijo para los valores del eje Y
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16 // Tamaño de la fuente de la leyenda
                            }
                        }
                    }
                }
            }
        });

        function cambiarColor() {
            var dashboardLink = document.getElementById("dashboardLink");
            var dashboardLink = document.getElementById("dashboardContainer");
            dashboardLink.classList.add("text-gray-100");
            dashboardLink.classList.add("bg-gris-clarito");
        }

        // Llamada a la función para cambiar el color
        cambiarColor();
    </script>
</body>
