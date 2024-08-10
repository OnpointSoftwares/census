<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Enumerator Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .task-status {
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
        }

        .task-status.pending {
            background-color: #f39c12;
        }

        .task-status.completed {
            background-color: #28a745;
        }

        .task-status.syncing {
            background-color: #007bff;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center">Census Enumerator</h4>
            <hr class="bg-secondary">
            <a href="#overview"><i class="fas fa-home"></i> Overview</a>
            <a href="#tasks"><i class="fas fa-tasks"></i> Tasks</a>
            <a href="#collect-data"><i class="fas fa-edit"></i> Collect Data</a>
            <a href="#sync"><i class="fas fa-sync"></i> Sync Data</a>
            <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 class="mb-4">Enumerator Dashboard</h2>

            <!-- Task Overview -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Task Overview
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Tasks</h5>
                                    <p class="display-6">10</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pending Tasks</h5>
                                    <p class="display-6">4</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Completed Tasks</h5>
                                    <p class="display-6">6</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task Management -->
            <div id="tasks" class="card mb-4">
                <div class="card-header bg-success text-white">
                    Tasks
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Household Survey - Region North</span>
                            <span class="task-status pending">Pending</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Household Survey - Region South</span>
                            <span class="task-status completed">Completed</span>
                        </li>
                        <!-- Add more tasks as needed -->
                    </ul>
                </div>
            </div>

            <!-- Data Collection Form -->
            <div id="collect-data" class="card mb-4">
                <div class="card-header bg-info text-white">
                    Collect Data
                </div>
                <div class="card-body">
                    <form id="dataCollectionForm">
                        <div class="mb-3">
                            <label for="householdId" class="form-label">Household ID</label>
                            <input type="text" class="form-control" id="householdId" placeholder="Enter Household ID" required>
                        </div>
                        <div class="mb-3">
                            <label for="householdHead" class="form-label">Household Head</label>
                            <input type="text" class="form-control" id="householdHead" placeholder="Enter Household Head Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-control" id="region" required>
                                <option value="" disabled selected>Select Region</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                            </select>
                        </div>
                        <!-- Add more fields as needed -->
                        <button type="submit" class="btn btn-primary">Submit Data</button>
                    </form>
                </div>
            </div>

            <!-- Sync Data -->
            <div id="sync" class="card">
                <div class="card-header bg-warning text-white">
                    Sync Data
                </div>
                <div class="card-body text-center">
                    <p>Ensure all data is synchronized with the central system.</p>
                    <button class="btn btn-warning">Sync Now</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to Handle Form Submission -->
    <script>
        document.getElementById('dataCollectionForm').addEventListener('submit', function (event) {
            event.preventDefault();
            // Handle form submission
            // You can add AJAX to submit the data to your server or directly handle it with PHP
            alert('Data submitted successfully!');
        });
    </script>

</body>

</html>
