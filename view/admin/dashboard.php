<?php include_once "navbarAdmin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div id="dashboard-content" class="container mx-auto p-4 mt-16" style="margin-left: 250px;">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <canvas class="chart w-full h-64" id="membershipChart"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <canvas class="chart w-full h-64" id="clientChart"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <canvas class="chart w-full h-64" id="revenueChart"></canvas>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold">Historial</h2>
            <table class="mt-4 w-full table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/3">Fecha</th>
                        <th class="w-1/3">Descripción</th>
                        <th class="w-1/3">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">2024-01-01</td>
                        <td class="border px-4 py-2">Licencia básica</td>
                        <td class="border px-4 py-2">$100</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-01-05</td>
                        <td class="border px-4 py-2">Licencia pro</td>
                        <td class="border px-4 py-2">$150</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-01-10</td>
                        <td class="border px-4 py-2">Licencia regular</td>
                        <td class="border px-4 py-2">$80</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var membershipData = { labels: ['Básica', 'Pro', 'Regular'], datasets: [{ data: [50, 30, 20], backgroundColor: ['blue', 'green', 'orange'] }] };
        var clientData = { labels: ['Nuevos', 'Recurrentes'], datasets: [{ data: [70, 30], backgroundColor: ['blue', 'green'] }] };
        var revenueData = { labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'], datasets: [{ label: 'Ganancias', data: [500, 600, 700, 800, 900, 1000], backgroundColor: 'blue' }] };

        var membershipChart = new Chart(document.getElementById('membershipChart').getContext('2d'), { type: 'pie', data: membershipData });
        var clientChart = new Chart(document.getElementById('clientChart').getContext('2d'), { type: 'doughnut', data: clientData });
        var revenueChart = new Chart(document.getElementById('revenueChart').getContext('2d'), { type: 'line', data: revenueData });
    </script>
</body>

</html>
