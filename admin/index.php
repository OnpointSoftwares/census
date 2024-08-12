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
<!-- Task Assignment Section -->
<section id="tasks" class="mt-5">
    <h2 class="mb-4">Assign Tasks to Enumerators</h2>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Task Assignment
        </div>
        <div class="card-body">
            <form id="assignTaskForm">
                <div class="mb-3">
                    <label for="enumerator" class="form-label">Select Enumerator</label>
                    <select id="enumerator" class="form-select">
                        <!-- Enumerator options will be loaded here -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="task_description" class="form-label">Task Description</label>
                    <textarea id="task_description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Assign Task</button>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchEnumerators();

        document.getElementById('assignTaskForm').addEventListener('submit', function (e) {
            e.preventDefault();
            assignTask();
        });
    });

    function fetchEnumerators() {
        fetch('fetch_enumerators.php')
            .then(response => response.json())
            .then(data => {
                const enumeratorSelect = document.getElementById('enumerator');
                data.forEach(enumerator => {
                    const option = document.createElement('option');
                    option.value = enumerator.id;
                    option.textContent = enumerator.name;
                    enumeratorSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching enumerators:', error));
    }

    function assignTask() {
        const enumerator_id = document.getElementById('enumerator').value;
        const task_description = document.getElementById('task_description').value;

        fetch('assign_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ enumerator_id, task_description })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Task assigned successfully');
                document.getElementById('assignTaskForm').reset();
            } else {
                alert('Error assigning task');
            }
        })
        .catch(error => console.error('Error assigning task:', error));
    }
</script>

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

  <!-- Users Section -->
<section id="users" class="mt-5">
    <h2 class="mb-4">Users</h2>
    <div class="card">
        <div class="card-header bg-primary text-white">
            User Management
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTable">
                    <!-- User data will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>
</section>

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
      fetchUsersData()
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
