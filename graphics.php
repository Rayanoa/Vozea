<?php
require_once "connexion.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graphiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body, html { margin: 0; height: 100%; }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            width: 350px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .chart-card h2 {
            margin: 0 0 20px 0;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        #myChart {
            width: 260px !important;
            height: 260px !important;
            margin: auto;
        }
    </style>
</head>

<body>

<?php
$stmt = $path->query("
    SELECT status, COUNT(*) as total
    FROM users_tasks
    GROUP BY status
");

$data = [
    "fait" => 0,
    "en cours" => 0,
    "a faire" => 0
];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    switch ($row['status']) {
        case 0:
            $data["a faire"] = $row['total'];
            break;
        case 1:
            $data["en cours"] = $row['total'];
            break;
        case 2:
            $data["fait"] = $row['total'];
            break;
    }
}
?>

<div class="wrapper">

    <!-- NAVBAR -->
    <div class="sidebar">
        <?php include __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- CONTENU -->
    <div class="main-content">
        <div class="chart-card">
            <h2>Statut des tâches</h2>
            <canvas id="myChart"></canvas>
        </div>
    </div>

</div>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Fait', 'En cours', 'À faire'],
        datasets: [{
            data: [
                <?= $data['fait'] ?>,
                <?= $data['en cours'] ?>,
                <?= $data['a faire'] ?>
            ],
            backgroundColor: [
                'rgba(40, 167, 69, 0.4)',
                'rgba(255, 193, 7, 0.4)',
                'rgba(220, 53, 69, 0.4)'
            ],
            borderColor: [
                '#28a745',
                '#ffc107',
                '#dc3545'
            ],
            borderWidth: 3,
            hoverBorderWidth: 5,
            cutout: '75%'   // cercle fin
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                padding: 10,
                bodyFont: { size: 14 },
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const value = context.raw;
                        const percent = ((value / total) * 100).toFixed(1);
                        return `${context.label} : ${value} (${percent}%)`;
                    }
                }
            }
        }
    }
});
</script>

</body>
</html>