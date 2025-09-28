{{-- <!DOCTYPE html>
<html>
<head>
    <title>Task Module</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .task-item { margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .remove-btn { color: red; cursor: pointer; margin-left: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Task Module</h2>

<form id="taskForm">
    <div id="tasksContainer">
        <!-- First task input -->
        <div class="task-item">
            <input type="text" name="tasks[0][title]" placeholder="Task Title" required>
            <input type="text" name="tasks[0][description]" placeholder="Task Description">
            <span class="remove-btn" onclick="removeTask(this)">Remove</span>
        </div>
    </div>

    <button type="button" id="addTaskBtn">Add New Task</button>
    <button type="submit">Save All Tasks</button>
</form>

<div id="response" style="margin-top: 20px;"></div>

<script>
let taskIndex = 1;

// Add new task dynamically
document.getElementById('addTaskBtn').addEventListener('click', function() {
    const container = document.getElementById('tasksContainer');
    const div = document.createElement('div');
    div.classList.add('task-item');
    div.innerHTML = `
        <input type="text" name="tasks[${taskIndex}][title]" placeholder="Task Title" required>
        <input type="text" name="tasks[${taskIndex}][description]" placeholder="Task Description">
        <span class="remove-btn" onclick="removeTask(this)">Remove</span>
    `;
    container.appendChild(div);
    taskIndex++;
});

// Remove task field
function removeTask(el) {
    el.parentNode.remove();
}

// AJAX form submit
document.getElementById('taskForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent page reload

    const formData = new FormData(this);
    const data = {};

    // Convert formData to JSON
    formData.forEach((value, key) => {
        const match = key.match(/tasks\[(\d+)\]\[(.+)\]/);
        if(match) {
            const index = match[1];
            const field = match[2];
            if(!data['tasks']) data['tasks'] = [];
            if(!data['tasks'][index]) data['tasks'][index] = {};
            data['tasks'][index][field] = value;
        }
    });

    fetch('{{ url("/api/tasks") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        const responseDiv = document.getElementById('response');
        if(res.status) {
            responseDiv.innerHTML = <pre class="success">${JSON.stringify(res, null, 2)}</pre>;
            
            // Optionally reset form
            // document.getElementById('taskForm').reset();
            // Reset taskIndex and remove extra fields if needed
        } else {
            responseDiv.innerHTML = <pre class="error">${JSON.stringify(res, null, 2)}</pre>;
        }
    })
    .catch(err => {
        document.getElementById('response').innerHTML = <pre class="error">${err}</pre>;
        console.error(err);
    });
});
</script>

</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Task Module</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .task-item { margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .remove-btn { color: red; cursor: pointer; margin-left: 10px; }
        .success { color: green; white-space: pre-wrap; }
        .error { color: red; white-space: pre-wrap; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
        }
    </style>
</head>
<body>

<h2>Task Module</h2>

<form id="taskForm">
    <div id="tasksContainer">
        <div class="task-item">
            <input type="text" name="tasks[0][title]" placeholder="Task Title" required>
            <input type="text" name="tasks[0][description]" placeholder="Task Description">
            <span class="remove-btn" onclick="removeTask(this)">Remove</span>
        </div>
    </div>

    <button type="button" id="addTaskBtn">Add New Task</button>
    <button type="submit">Save All Tasks</button>
</form>

<div id="response" style="margin-top: 20px;"></div>

<h3>Task List</h3>
<table id="taskTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Task Title</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <!-- Tasks will be loaded here -->
    </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load tasks immediately on page load
    loadTasks();
});

// Function to fetch tasks from API and render table
function loadTasks() {
    fetch('{{ url("/api/tasks") }}')
    .then(res => res.json())
    .then(res => {
        if(res.status && res.data.length) {
            renderTasks(res.data);
        }
    })
    .catch(err => console.error(err));
}

// Render tasks in the table
function renderTasks(tasks) {
    const tbody = document.querySelector('#taskTable tbody');
    tbody.innerHTML = ""; // clear old rows
    tasks.forEach((task, index) => {
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${task.title}</td>
                <td>${task.description ?? ''}</td>
            </tr>
        `;
    });
}

    
let taskIndex = 1;

// Helper function to collect current tasks from form inputs
function collectCurrentTasks() {
    const tasks = [];
    document.querySelectorAll('.task-item').forEach((item) => {
        const title = item.querySelector('input[name$="[title]"]').value;
        const description = item.querySelector('input[name$="[description]"]').value;
        if(title.trim() !== '') {
            tasks.push({ title, description });
        }
    });
    return tasks;
}

// Function to render tasks in table
function renderTasks(tasks) {
    const tbody = document.querySelector('#taskTable tbody');
    tbody.innerHTML = "";
    tasks.forEach((task, index) => {
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${task.title}</td>
                <td>${task.description ?? ""}</td>
            </tr>
        `;
    });
}

// Add new task dynamically
document.getElementById('addTaskBtn').addEventListener('click', function() {
    const container = document.getElementById('tasksContainer');
    const div = document.createElement('div');
    div.classList.add('task-item');
    div.innerHTML = `
        <input type="text" name="tasks[${taskIndex}][title]" placeholder="Task Title" required>
        <input type="text" name="tasks[${taskIndex}][description]" placeholder="Task Description">
        <span class="remove-btn" onclick="removeTask(this)">Remove</span>
    `;
    container.appendChild(div);
    taskIndex++;

    // Update table immediately
    renderTasks(collectCurrentTasks());
});

// Remove task field
function removeTask(el) {
    el.parentNode.remove();
    // Update table immediately
    renderTasks(collectCurrentTasks());
}

// AJAX form submit
document.getElementById('taskForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const tasks = collectCurrentTasks();
    if(tasks.length === 0) return alert("Please add at least one task.");

    fetch('{{ url("/api/tasks") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ tasks })
    })
    .then(res => res.json())
    .then(res => {
        const responseDiv = document.getElementById('response');
        if(res.status) {
            responseDiv.innerHTML = `<pre class="success">Tasks saved successfully!</pre>`;
            renderTasks(res.data); // update table with saved tasks

            // Reset form
            document.getElementById('tasksContainer').innerHTML = `
                <div class="task-item">
                    <input type="text" name="tasks[0][title]" placeholder="Task Title" required>
                    <input type="text" name="tasks[0][description]" placeholder="Task Description">
                    <span class="remove-btn" onclick="removeTask(this)">Remove</span>
                </div>
            `;
            taskIndex = 1;
        } else {
            responseDiv.innerHTML = `<pre class="error">${JSON.stringify(res, null, 2)}</pre>`;
        }
    })
    .catch(err => {
        document.getElementById('response').innerHTML = `<pre class="error">${err}</pre>`;
        console.error(err);
    });
});

// Initial load from API
function loadTasks() {
    fetch('{{ url("/api/tasks") }}')
    .then(res => res.json())
    .then(res => {
        if(res.status && res.data.length) {
            renderTasks(res.data);
        }
    })
    .catch(err => console.error(err));
}

document.addEventListener('DOMContentLoaded', loadTasks);
</script>


</body>
</html>
