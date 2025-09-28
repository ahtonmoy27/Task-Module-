
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Module</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Task management </h4>
    <button type="button" id="addTaskBtn" class="btn btn-primary">+ Add</button>
  </div>

  <form id="taskForm" class="mb-4">
    <div id="tasksContainer">
      <div class="task-item row align-items-center g-2 mb-2">
        <div class="col-md-5">
          <input type="text" name="tasks[0][title]" class="form-control" placeholder="Task Title" required>
        </div>
        <div class="col-md-5">
          <input type="text" name="tasks[0][description]" class="form-control" placeholder="Task Description">
        </div>
        <div class="col-md-2 text-end">
          <button type="button" class="btn btn-danger btn-sm" onclick="removeTask(this)">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="d-flex gap-2 mt-3">
      <button type="submit" class="btn btn-success">Save All Tasks</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>

  <div id="response" class="mt-2"></div>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover mb-0" id="taskTable">
        <thead class="table-light">
          <tr>
            <th style="width:5%">#</th>
            <th style="width:30%">Task Title</th>
            <th style="width:50%">Description</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editTaskForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editTaskId">
        <div class="mb-3">
          <label>Title</label>
          <input type="text" id="editTaskTitle" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Description</label>
          <input type="text" id="editTaskDescription" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTasks();
});

let taskIndex = 1;

function loadTasks() {
    fetch('/api/tasks')
    .then(res => res.json())
    .then(res => {
        if(res.status) renderTasks(res.data);
        else renderTasks([]);
    });
}

function collectCurrentTasks() {
    const tasks = [];
    document.querySelectorAll('.task-item').forEach(item => {
        const title = item.querySelector('input[name$="[title]"]').value;
        const description = item.querySelector('input[name$="[description]"]').value;
        if(title.trim() !== '') tasks.push({ title, description });
    });
    return tasks;
}

function renderTasks(tasks) {
    const tbody = document.querySelector('#taskTable tbody');
    tbody.innerHTML = "";
    tasks.forEach((task, index) => {
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${task.title}</td>
                <td>${task.description ?? ''}</td>
                <td>
                  <button class="btn btn-sm btn-primary edit-task-btn"
                    data-id="${task.id}"
                    data-title="${task.title.replace(/"/g,'&quot;')}"
                    data-description="${task.description ? task.description.replace(/"/g,'&quot;') : ''}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-danger delete-task-btn" data-id="${task.id}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
            </tr>
        `;
    });
}

document.getElementById('addTaskBtn').addEventListener('click', function() {
    const container = document.getElementById('tasksContainer');
    const div = document.createElement('div');
    div.classList.add('task-item','row','align-items-center','g-2','mb-2');
    div.innerHTML = `
        <div class="col-md-5">
          <input type="text" name="tasks[${taskIndex}][title]" class="form-control" placeholder="Task Title" required>
        </div>
        <div class="col-md-5">
          <input type="text" name="tasks[${taskIndex}][description]" class="form-control" placeholder="Task Description">
        </div>
        <div class="col-md-2 text-end">
          <button type="button" class="btn btn-danger btn-sm" onclick="removeTask(this)">
            <i class="bi bi-trash"></i>
          </button>
        </div>
    `;
    container.appendChild(div);
    taskIndex++;
});

function removeTask(el) {
    el.closest('.task-item').remove();
}

document.addEventListener('click', function(e) {
    // Edit
    if(e.target.closest('.edit-task-btn')) {
        const btn = e.target.closest('.edit-task-btn');
        document.getElementById('editTaskId').value = btn.dataset.id;
        document.getElementById('editTaskTitle').value = btn.dataset.title;
        document.getElementById('editTaskDescription').value = btn.dataset.description;
        new bootstrap.Modal(document.getElementById('editTaskModal')).show();
    }

    // Delete
    if(e.target.closest('.delete-task-btn')) {
        const btn = e.target.closest('.delete-task-btn');
        const id = btn.dataset.id;
        if(confirm('Are you sure you want to delete this task?')) {
            fetch(`/api/tasks/${id}`, { method:'DELETE' })
            .then(res=>res.json())
            .then(res=>{
                if(res.status) { loadTasks(); document.getElementById('response').innerHTML = `<pre class="text-success">${res.message}</pre>`; }
            });
        }
    }
});

// Save new tasks
document.getElementById('taskForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const tasks = collectCurrentTasks();
    if(tasks.length === 0) return alert('Please add at least one task.');

    fetch('/api/tasks', {
        method:'POST',
        headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify({ tasks })
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.status) {
            document.getElementById('response').innerHTML = `<pre class="text-success">${res.message}</pre>`;
            renderTasks(res.data);
            // reset form
            document.getElementById('tasksContainer').innerHTML = `
                <div class="task-item row align-items-center g-2 mb-2">
                  <div class="col-md-5">
                    <input type="text" name="tasks[0][title]" class="form-control" placeholder="Task Title" required>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="tasks[0][description]" class="form-control" placeholder="Task Description">
                  </div>
                  <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTask(this)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </div>
            `;
            taskIndex = 1;
        }
    });
});

// Update task
document.getElementById('editTaskForm').addEventListener('submit', function(e){
    e.preventDefault();
    const id = document.getElementById('editTaskId').value;
    const title = document.getElementById('editTaskTitle').value;
    const description = document.getElementById('editTaskDescription').value;

    fetch(`/api/tasks/${id}`, {
        method:'PUT',
        headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify({ title, description })
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.status) {
            bootstrap.Modal.getInstance(document.getElementById('editTaskModal')).hide();
            loadTasks();
            document.getElementById('response').innerHTML = `<pre class="text-success">${res.message}</pre>`;
        }
    });
});
</script>

</body>
</html>
