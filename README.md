
First, clone the project repository to  local machine.
configure  database settings.
Database Setup:

Once  environment is configured, run the command php artisan migrate to set up the database tables.
To populate the database with initial data, execute php artisan migrate:fresh --seed. This will create default records that you can utilize during testing.
Admin Credentials:

Admin can log in using the admin credentials provided:
Email: admin@gmail.com
Password: 123456
After logging in, Admin will have access to the administrative dashboard.
Creating Tasks:

From the dashboard, navigate to the tasks section. Here, Admin can create new tasks and assign  to specific employees.
While creating a task, make sure to select the employee from the dropdown list to whom Admin want to assign the task.

Employee Permissions:
Each employee has unique permissions that allow them to view only their assigned tasks.

Task Management:
Employees can log in using their credentials and will see only the tasks assigned to them.
They can mark tasks as complete once they have finished them, providing an efficient way to track progress.