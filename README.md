# Task Manager

![index.php](./screenshots/index.png)
![Edit Task](./screenshots/edit.png)
![Edit Success](./screenshots/success.png)

A modern Task Manager web application built with PHP (RESTful API), Bootstrap 5, and Font Awesome.
It allows users to Create, Read, Update, and Delete (CRUD) tasks with a simple, responsive, and elegant UI.

---

## Features

- CRUD operations: Create, edit, and delete tasks.
- Task attributes: Status (Pending, In Progress, Completed) & Priority (Low, Medium, High).
- Responsive UI with Bootstrap 5.
- SweetAlert2 confirmations for deleting tasks.
- RESTful API backend for seamless integration.

---

## Technologies

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5
- Font Awesome 6
- SweetAlert2
- JavaScript (Fetch API)

---

## Project Structure

task-manager/
│
├─ api/
│   └─ tasks.php          # API routes for tasks (RESTful endpoints)
│
├─ controllers/
│   └─ TaskController.php # Handles requests and interacts with Task model
│
├─ models/
│   └─ Task.php           # Task class with CRUD functions
│
├─ config/
│   └─ Database.php       # Database connection
│
├─ public/
│   └─ index.php          # Frontend UI for task management
│
└─ README.md

---

## Setup & Installation

1. Clone the repository:

git clone https://github.com/yourusername/task-manager.git

2. Create a MySQL database (e.g., task_manager) and import the table:

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50) DEFAULT 'pending',
    priority VARCHAR(50) DEFAULT 'low',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. Configure database credentials in config/Database.php.

4. Open the project in your local server:

http://localhost/task-manager/public/index.php

---

## API Endpoints

Method   | Endpoint         | Description
---------|----------------|-----------------------------
GET      | /api/tasks      | Get all tasks
GET      | /api/tasks/{id} | Get a single task by ID
POST     | /api/tasks      | Create a new task
PUT      | /api/tasks/{id} | Update a task by ID
DELETE   | /api/tasks/{id} | Delete a task by ID

---

## Usage

1. Open the frontend page: public/index.php
2. Add a new task using the "Add Task" form.
3. Edit a task using the edit button (modal opens).
4. Delete a task using the delete button (SweetAlert2 confirmation).
5. All operations interact with the RESTful API.

---

## License

This project is open-source and free to use under the MIT License.
