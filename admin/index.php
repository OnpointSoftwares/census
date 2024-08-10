<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Census System Admin Dashboard</title>
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
    .card {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="d-flex">
    <div class="sidebar p-3">
      <h4 class="text-center text-white">Census Admin</h4>
      <hr class="bg-secondary">
      <a href="index.php"><i class="fas fa-chart-line"></i> Overview</a>
      <a href="#statistics"><i class="fas fa-chart-pie"></i> Statistics</a>
      <a href="#demographics"><i class="fas fa-users"></i> Demographics</a>
      <a href="datasets.php"><i class="fas fa-database"></i> Datasets</a>
      <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
      <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
      <!-- Overview Section -->
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
          <div class="col-md-4">
            <div class="card text-white bg-warning">
              <div class="card-body">
                <h5 class="card-title">Regions Covered</h5>
                <p class="card-text"><i class="fas fa-map-marked-alt"></i> <span id="total_regions">Loading...</span></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Statistics Section -->
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

      <!-- Demographics Section -->
      <section id="demographics" class="mt-5">
        <h2 class="mb-4">Demographics</h2>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-success text-white">
                Population by Region
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Region</th>
                      <th>Total Population</th>
                      <th>Male</th>
                      <th>Female</th>
                      <th>Other</th>
                    </tr>
                  </thead>
                  <tbody id="demographicsTable">
                    <!-- Data will be inserted here -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Datasets Section -->
      <section id="datasets" class="mt-5">
        <h2 class="mb-4">Datasets</h2>
        <div class="card">
          <div class="card-header bg-danger text-white">
            Available Datasets
          </div>
          <div class="card-body">
            <p>List of datasets will be available here.</p>
          </div>
        </div>
      </section>

      <!-- Settings Section -->
      <section id="settings" class="mt-5">
        <h2 class="mb-4">Settings</h2>
        <div class="card">
          <div class="card-header bg-dark text-white">
            Account Settings
          </div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
      </section>

      <!-- Logout Section -->
      <section id="logout" class="mt-5">
        <h2 class="mb-4">Logout</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </section>

    </div>
  </div>

  <!-- Bootstrap and JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- JavaScript to Fetch and Display Data -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      fetchOverviewData();
      fetchStatisticsData();
      fetchDemographicsData();
    });

    function fetchOverviewData() {
      fetch('fetch_overview.php')
        .then(response => response.json())
        .then(data => {
          document.getElementById('total_population').textContent = data.total_population;
          document.getElementById('total_households').textContent = data.total_households;
          document.getElementById('total_regions').textContent = data.total_regions;
        })
        .catch(error => console.error('Error fetching overview data:', error));
    }

    function fetchStatisticsData() {
      fetch('fetch_statistics.php')
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

    function fetchDemographicsData() {
      fetch('fetch_demographics.php')
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
  </script>

</body>

</html>
