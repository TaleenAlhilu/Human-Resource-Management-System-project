<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
  <a class="navbar-brand" href="employee_dashboard.php">
    Employee Top Menu
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#employeeTopNav"
          aria-controls="employeeTopNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="employeeTopNav">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="employee_create_vacation_request_form.php">
          <i class="fa-solid fa-suitcase-rolling mr-1"></i>
          Create Vacation Request
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="employee_create_overtime_request_form.php">
          <i class="fa-solid fa-business-time mr-1"></i>
          Create Overtime Request
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="employee_requests.php">
          <i class="fa-solid fa-code-pull-request mr-1"></i>
          My Requests
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-danger" href="employee_login_form.php">
          <i class="fa-solid fa-right-from-bracket mr-1"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
</nav>
