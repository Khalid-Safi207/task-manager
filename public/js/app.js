const taskForm = document.getElementById("taskForm");
const taskList = document.getElementById("taskList");
const editTaskForm = document.getElementById("editTaskForm");

taskForm.onsubmit = (e) => {
    e.preventDefault();
    createTask();
}

editTaskForm.onsubmit = (e) => {
    e.preventDefault();
    editTask();
}
document.onload = getAllTasks();
// Get All Tasks
async function getAllTasks() {
    document.querySelector('.loader').style.display = 'block';
    await fetch("../api/tasks").then((res) => res.json()).then((data) => {
        document.querySelector('.loader').style.display = 'none';
        console.log(data);

        data["data"].forEach(element => {
            taskList.innerHTML += `
            <div class="col-md-4 mb-4" data-task-id="${element['id']}">
                <div class="card shadow-sm p-3">
                    <h5 class="card-title text-primary">${element['title']}</h5>
                    <p class="card-text">${element['description']}</p>
                    <p class="text-muted small">Priority: ${element['priority']} | Status: ${element['status']}</p>
                    <div class="actions">
                        <button class="btn btn-sm btn-warning" onclick="openEditModal(this.parentElement.parentElement.parentElement.getAttribute('data-task-id'))"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTask(this.parentElement.parentElement.parentElement.getAttribute('data-task-id'))"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div> 
            `

        });

    })
}

// Create New Task
function createTask() {
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const status = document.getElementById("status").value;
    const priority = document.getElementById("priority").value;

    fetch("../api/tasks", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            'title': title,
            'description': description,
            'status': status,
            'priority': priority
        })
    }).then((res) => res.json()).then((data) => {
        if (data['is_success']) {

            Swal.fire({
                title: 'Success',
                text: data['message'],
                icon: "success"
            }).then(() => { location.reload() });
        } else {
            Swal.fire({
                title: 'Error',
                text: data['message'],
                icon: "error"
            }).then(() => { location.reload() });
        }

    })
}

// Edit Task
function openEditModal(id) {
    document.querySelector('.loader').style.display = 'block';

    fetch('../api/tasks/' + id).then((res) => res.json()).then((data) => {
        task = data["data"];
        document.getElementById('editTaskId').value = task.id;
        document.getElementById('editTitle').value = task.title;
        document.getElementById('editDescription').value = task.description;
        document.getElementById('editPriority').value = task.priority;
        document.getElementById('editStatus').value = task.status;

        const editModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
        editModal.show();
        document.querySelector('.loader').style.display = 'none';


    })
}
function editTask() {
    const editId = document.getElementById('editTaskId').value
    const editTitle = document.getElementById("editTitle").value;
    const editDescription = document.getElementById("editDescription").value;
    const editStatus = document.getElementById("editStatus").value;
    const editPriority = document.getElementById("editPriority").value;
    fetch("../api/tasks/" + editId, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        }, body: JSON.stringify({
            'title': editTitle,
            'description': editDescription,
            'status': editStatus,
            'priority': editPriority
        })
    }).then((res) => res.json()).then((data) => {
        if (data['is_success']) {

            Swal.fire({
                title: 'Success',
                text: data['message'],
                icon: "success"
            }).then(() => { location.reload() });
        } else {
            Swal.fire({
                title: 'Error',
                text: data['message'],
                icon: "error"
            }).then(() => { location.reload() });
        }

    })
}

// Delete Task
function deleteTask(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This task will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../api/tasks/" + id, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            }).then((res) => res.json()).then((data) => {
                if (data['is_success']) {

                    Swal.fire({
                        title: 'Success',
                        text: data['message'],
                        icon: "success"
                    }).then(() => { location.reload() });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data['message'],
                        icon: "error"
                    }).then(() => { location.reload() });
                }

            })
        }
    });
}