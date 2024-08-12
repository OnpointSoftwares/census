<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prepare Datasets - Census Admin</title>
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center text-white">Census Admin</h4>
            <hr class="bg-secondary">
            <a href="index.php#overview"><i class="fas fa-chart-line"></i> Overview</a>
            <a href="index.php#statistics"><i class="fas fa-chart-pie"></i> Statistics</a>
            <a href="index.php#demographics"><i class="fas fa-users"></i> Demographics</a>
            <a href="datasets.php"><i class="fas fa-database"></i> Datasets</a>
            <a href="index.php#settings"><i class="fas fa-cog"></i> Settings</a>
            <a href="index.php#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 class="mb-4">Prepare Datasets</h2>

            <!-- Create Dataset Form -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Create New Dataset
                </div>
                <div class="card-body">
                    <form id="createDatasetForm">
                        <div class="mb-3">
                            <label for="datasetName" class="form-label">Dataset Name</label>
                            <input type="text" class="form-control" id="datasetName" placeholder="Enter dataset name" required>
                        </div>
                        <div class="mb-3">
                            <label for="datasetDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="datasetDescription" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Create Dataset</button>
                    </form>
                </div>
            </div>

            <!-- Datasets List -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    Existing Datasets
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="datasetsTable">
                            <!-- Data will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to Handle Form Submission and Data Fetching -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchDatasets();

            // Handle form submission
            document.getElementById('createDatasetForm').addEventListener('submit', function (event) {
                event.preventDefault();

                const datasetName = document.getElementById('datasetName').value;
                const datasetDescription = document.getElementById('datasetDescription').value;

                const formData = new FormData();
                formData.append('name', datasetName);
                formData.append('description', datasetDescription);

                fetch('create_dataset.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Dataset created successfully');
                        fetchDatasets();
                        document.getElementById('createDatasetForm').reset();
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error creating dataset:', error));
            });
        });

        function fetchDatasets() {
            fetch('fetch_datasets.php')
                .then(response => response.json())
                .then(data => {
                    const datasetsTable = document.getElementById('datasetsTable');
                    datasetsTable.innerHTML = '';

                    data.forEach(dataset => {
                        const row = `<tr>
                            <td>${dataset.id}</td>
                            <td>${dataset.name}</td>
                            <td>${dataset.description}</td>
                            <td>${dataset.created_at}</td>
                            <td>
                                <a href="export_dataset.php?id=${dataset.name}" class="btn btn-sm btn-primary">Export</a>
                            </td>
                        </tr>`;
                        datasetsTable.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => console.error('Error fetching datasets:', error));
        }
    </script>

</body>

</html>
