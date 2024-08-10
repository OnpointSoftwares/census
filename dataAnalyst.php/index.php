<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analyst Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: #fff;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 1.1em;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card-title {
            color: #495057;
        }

        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center">Data Analyst</h4>
            <hr class="bg-secondary">
            <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#visualizations"><i class="fas fa-chart-bar"></i> Visualizations</a>
            <a href="#datasets"><i class="fas fa-database"></i> Datasets</a>
            <a href="#analysis"><i class="fas fa-search"></i> Advanced Analysis</a>
            <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 class="mb-4">Data Analyst Dashboard</h2>

            <!-- Dashboard Overview -->
            <div id="dashboard" class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Dashboard Overview
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Households</h5>
                                    <p class="display-6">1,234</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Individuals</h5>
                                    <p class="display-6">4,567</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pending Tasks</h5>
                                    <p class="display-6">56</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visualizations -->
            <div id="visualizations" class="card mb-4">
                <div class="card-header bg-info text-white">
                    Data Visualizations
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="ageDistributionChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="genderDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dataset Management -->
            <div id="datasets" class="card mb-4">
                <div class="card-header bg-success text-white">
                    Datasets
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Household Data - North</td>
                                <td>2024-07-01</td>
                                <td>
                                    <a href="export.php?id=1" class="btn btn-custom btn-sm">Export CSV</a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Advanced Analysis -->
            <div id="analysis" class="card">
                <div class="card-header bg-warning text-white">
                    Advanced Analysis
                </div>
                <div class="card-body">
                    <p>Use the following tools to perform in-depth statistical analysis.</p>
                    <button class="btn btn-warning">Run Analysis</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript for Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Age Distribution Chart
            const ageDistributionCtx = document.getElementById('ageDistributionChart').getContext('2d');
            new Chart(ageDistributionCtx, {
                type: 'bar',
                data: {
                    labels: ['0-18', '19-35', '36-50', '51-65', '65+'],
                    datasets: [{
                        label: 'Age Distribution',
                        data: [200, 500, 700, 500, 300],
                        backgroundColor: '#007bff',
                        borderColor: '#0056b3',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gender Distribution Chart
            const genderDistributionCtx = document.getElementById('genderDistributionChart').getContext('2d');
            new Chart(genderDistributionCtx, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female', 'Other'],
                    datasets: [{
                        label: 'Gender Distribution',
                        data: [60, 35, 5],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        borderColor: '#ffffff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>

</body>

</html>
