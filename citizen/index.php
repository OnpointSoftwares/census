<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Dashboard</title>
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
            <h4 class="text-center">citizen</h4>
            <hr class="bg-secondary">
            <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#visualizations"><i class="fas fa-chart-bar"></i> Visualizations</a>
    
            <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 class="mb-4">Citizen</h2>

            <!-- Dashboard Overview -->
            <div id="dashboard" class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Dashboard Overview
                </div>
                <div class="card-body">
                <section id="overview">
        <h2 class="mb-4">Overview</h2>
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Population</h5>
                <p class="card-text"><i class="fas fa-users"></i> <span id="total_population">Loading...</span></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Households</h5>
                <p class="card-text"><i class="fas fa-home"></i> <span id="total_households">Loading...</span></p>
              </div>
            </div>
          </div>
         
      </section>
            </div>

            <!-- Visualizations -->
            <div id="visualizations" class="card mb-4">
                <div class="card-header bg-info text-white">
                    Data Visualizations
                </div>
                <section id="statistics" class="mt-5">
        <h2 class="mb-4">Statistics</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-info text-white">
                Gender Distribution
              </div>
              <div class="card-body">
                <canvas id="genderChart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-info text-white">
                Age Groups
              </div>
              <div class="card-body">
                <canvas id="ageChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section>
            </div>

            <!-- Dataset Management -->
           

            <!-- Advanced Analysis -->
           

    <!-- Bootstrap and JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JavaScript for Charts -->
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
        document.addEventListener('DOMContentLoaded', function () {
      fetchOverviewData();
      fetchStatisticsData();
      fetchDemographicsData();
      fetchUsersData()
    });

    function fetchOverviewData() {
      fetch('../admin/fetch_overview.php')
        .then(response => response.json())
        .then(data => {
          document.getElementById('total_population').textContent = data.total_population;
          document.getElementById('total_households').textContent = data.total_households;
          document.getElementById('total_regions').textContent = data.total_regions;
        })
        .catch(error => console.error('Error fetching overview data:', error));
    }

    function fetchStatisticsData() {
      fetch('../admin/fetch_statistics.php')
        .then(response => response.json())
        .then(data => {
          // Gender Distribution
          const genderCtx = document.getElementById('genderChart').getContext('2d');
          new Chart(genderCtx, {
            type: 'pie',
            data: {
              labels: ['Male', 'Female', 'Other'],
              datasets: [{
                label: '# of People',
                data: [data.gender.Male, data.gender.Female, data.gender.Other],
                backgroundColor: ['#007bff', '#dc3545', '#6c757d'],
              }]
            }
          });

          // Age Groups
          const ageCtx = document.getElementById('ageChart').getContext('2d');
          new Chart(ageCtx, {
            type: 'bar',
            data: {
              labels: ['0-18', '19-35', '36-60', '60+'],
              datasets: [{
                label: '# of People',
                data: [data.age['0-18'], data.age['19-35'], data.age['36-60'], data.age['60+']],
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
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
        })
        .catch(error => console.error('Error fetching statistics data:', error));
    }

    function fetchUsersData() {
    fetch('fetch_users.php')
        .then(response => response.json())
        .then(data => {
            const usersTable = document.getElementById('usersTable');
            data.forEach(user => {
                const row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role_id}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editUser(${user.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                </tr>`;
                usersTable.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(error => console.error('Error fetching users data:', error));
}

// Implement editUser and deleteUser functions
function editUser(userId) {
    // Logic to edit user (fetch user data, populate a form, etc.)
    alert('Edit user with ID: ' + userId);
}

function deleteUser(userId) {
    // Logic to delete user (confirm deletion, send delete request to server, etc.)
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User deleted successfully');
                location.reload();
            } else {
                alert('Error deleting user');
            }
        })
        .catch(error => console.error('Error deleting user:', error));
    }
}
    function fetchDemographicsData() {
      fetch('../admin/fetch_demographics.php')
        .then(response => response.json())
        .then(data => {
          const demographicsTable = document.getElementById('demographicsTable');
          data.forEach(region => {
            const row = `<tr>
              <td>${region.region}</td>
              <td>${region.total_population}</td>
              <td>${region.male}</td>
              <td>${region.female}</td>
              <td>${region.other}</td>
            </tr>`;
            demographicsTable.insertAdjacentHTML('beforeend', row);
          });
        })
        .catch(error => console.error('Error fetching demographics data:', error));
    }
        function fetchDatasets() {
            fetch('../admin/fetch_datasets.php')
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
                                <a href="../admin/export_dataset.php?id=${dataset.name}" class="btn btn-sm btn-primary">Export</a>
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
