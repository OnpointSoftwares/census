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

            <!-- Census Data Collection Form -->
            <section id="census-form" class="census-form">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Census Data Collection Form</h2>
                        <p>Please fill out the form to collect census data including households, regions, and individual details.</p>
                    </div>

                    <form id="census_data_form" method="post" role="form" class="php-email-form">
                        <!-- Household Information -->
                        <h3>Household Information</h3>
                        <div class="form-group">
                            <label for="household_id">Household ID</label>
                            <input type="text" name="household_id" class="form-control" id="household_id" placeholder="Unique Household ID" required>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select name="region" class="form-control" id="region" required>
                                <option value="" disabled selected>Select Region</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <!-- Add more regions as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="household_head">Household Head</label>
                            <select name="household_head" class="form-control" id="household_head" required>
                                <option value="" disabled selected>Select Household Head</option>
                                <!-- Options will be dynamically populated -->
                            </select>
                            <a href="add_household_head.html" class="btn btn-primary">Add Household Head</a>
                        </div>

                        <!-- Individual Information -->
                        <h3>Individual Information</h3>
                        <div id="individuals">
                            <div class="individual">
                                <div class="form-group">
                                    <label for="individual_name_1">Full Name</label>
                                    <input type="text" name="individual_name[]" class="form-control" id="individual_name_1" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="individual_age_1">Age</label>
                                    <input type="number" name="individual_age[]" class="form-control" id="individual_age_1" placeholder="Age" required>
                                </div>
                                <div class="form-group">
                                    <label for="individual_gender_1">Gender</label>
                                    <select name="individual_gender[]" class="form-control" id="individual_gender_1" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="individual_relation_1">Relation to Head of Household</label>
                                    <input type="text" name="individual_relation[]" class="form-control" id="individual_relation_1" placeholder="Relation to Head of Household" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="add_individual">Add Another Individual</button>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Census data has been submitted successfully. Thank you!</div>
                        </div>

                        <div class="text-center"><button type="submit" class="btn btn-primary">Submit Data</button></div>
                    </form>
                </div>
            </section>

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
        document.getElementById('add_individual').addEventListener('click', function () {
            const individualCount = document.querySelectorAll('.individual').length + 1;
            const individualDiv = document.createElement('div');
            individualDiv.classList.add('individual');
            individualDiv.innerHTML = `
                <h4>Individual ${individualCount}</h4>
                <div class="form-group">
                    <label for="individual_name_${individualCount}">Full Name</label>
                    <input type="text" name="individual_name[]" class="form-control" id="individual_name_${individualCount}" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label for="individual_age_${individualCount}">Age</label>
                    <input type="number" name="individual_age[]" class="form-control" id="individual_age_${individualCount}" placeholder="Age" required>
                </div>
                <div class="form-group">
                    <label for="individual_gender_${individualCount}">Gender</label>
                    <select name="individual_gender[]" class="form-control" id="individual_gender_${individualCount}" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="individual_relation_${individualCount}">Relation to Head of Household</label>
                    <input type="text" name="individual_relation[]" class="form-control" id="individual_relation_${individualCount}" placeholder="Relation to Head of Household" required>
                </div>`;
            document.getElementById('individuals').appendChild(individualDiv);
        });
        document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('census_data_form');
  const householdHeadSelect = document.getElementById('household_head');

  // Fetch and populate household heads
  function populateHouseholdHeads() {
    fetch('../includes/get_household_heads.php')
      .then(response => response.json())
      .then(data => {
        householdHeadSelect.innerHTML = '<option value="" disabled selected>Select Household Head</option>'; // Clear previous options
        data.forEach(head => {
          const option = document.createElement('option');
          option.value = head.id;
          option.textContent = head.name;
          householdHeadSelect.appendChild(option);
        });
      })
      .catch(error => console.error('Error fetching household heads:', error));
  }

  // Populate the dropdown on page load
  populateHouseholdHeads();

  form.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(form);

    fetch('../includes/process_census_data.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      console.log('Success:', data);
      document.querySelector('.sent-message').style.display = 'block';
      document.querySelector('.error-message').style.display = 'none';
    })
    .catch(error => {
      console.error('Error:', error);
      document.querySelector('.sent-message').style.display = 'none';
      document.querySelector('.error-message').style.display = 'block';
    });
  });

  document.getElementById('add_individual').addEventListener('click', function () {
    const individualContainer = document.getElementById('individuals');
    const count = individualContainer.children.length + 1;
    const newIndividual = `
      <div class="individual mt-3">
        <div class="form-group">
          <label for="individual_name_${count}">Full Name</label>
          <input type="text" name="individual_name[]" class="form-control" id="individual_name_${count}" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <label for="individual_age_${count}">Age</label>
          <input type="number" name="individual_age[]" class="form-control" id="individual_age_${count}" placeholder="Age" required>
        </div>
        <div class="form-group">
          <label for="individual_gender_${count}">Gender</label>
          <select name="individual_gender[]" class="form-control" id="individual_gender_${count}" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="individual_relation_${count}">Relation to Head of Household</label>
          <input type="text" name="individual_relation[]" class="form-control" id="individual_relation_${count}" placeholder="Relation to Head of Household" required>
        </div>
      </div>
    `;
    individualContainer.insertAdjacentHTML('beforeend', newIndividual);
  });
});

    </script>
</body>

</html>
