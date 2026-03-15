<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <!-- CUSTOM CSS -->
     <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="loader"></div>
<header>
    <h1><i class="fa-solid fa-tasks"></i> Task Manager</h1>
</header>

<div class="container my-4">

    <!-- Add Task Form -->
    <div class="card p-4 mb-4 shadow-sm">
        <h3 class="text-primary mb-3"><i class="fa-solid fa-plus"></i> Add New Task</h3>
        <form id="taskForm" class="row g-3">
            <div class="col-md-6">
                <input type="text" id="title" name="title" class="form-control" placeholder="Task Title" required>
            </div>
            <div class="col-md-6">
                <select name="priority" class="form-select" id="priority">
                    <option value="low">Low Priority</option>
                    <option value="medium">Medium Priority</option>
                    <option value="high">High Priority</option>
                </select>
            </div>
            <div class="col-12">
                <textarea name="description" id="description" class="form-control" rows="2" placeholder="Task Description" required></textarea>
            </div>
            <div class="col-md-6">
                <select name="status" class="form-select" id="status">
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="col-md-6 d-grid">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Task</button>
            </div>
        </form>
    </div>

    <!-- Task List -->
    <div class="row" id="taskList">
        
       
    </div>

</div>
<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editTaskModalLabel"><i class="fa-solid fa-pen-to-square"></i> Edit Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editTaskForm">
          <input type="hidden" id="editTaskId">
          <div class="mb-3">
            <label for="editTitle" class="form-label">Title</label>
            <input type="text" id="editTitle" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editDescription" class="form-label">Description</label>
            <textarea id="editDescription" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editPriority" class="form-label">Priority</label>
            <select id="editPriority" class="form-select">
              <option value="low">Low Priority</option>
              <option value="medium">Medium Priority</option>
              <option value="high">High Priority</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select id="editStatus" class="form-select">
              <option value="pending">Pending</option>
              <option value="in-progress">In Progress</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<footer>
    &copy; 2026 Task Manager. All Rights Reserved.
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.all.js" integrity="sha512-kEG1e68iTZ6mp4hawzUG6LqyzSdDY+wXV2OJ2OjU5tfg6daEbVUYKMxYutmnUN7iwKO2BPICXNE7yh2qtS5YHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- App.js -->
 <script src="./js/app.js"></script>
</body>
</html>