# Project Setup Guide

This is a simple timesheet app using Laravel. 

Follow the steps below to set up this project after cloning it from the repository.

---

## 1. Clone the Repository

Clone the repository to your machine

```bash
git clone https://github.com/sujithphpdeveloper/timesheets
cd timesheets
```

## 2. Install PHP Dependencies

Run Composer to install all the required PHP dependencies:
```bash
composer install
```

## 3. Set Up Environment Variables

If you don't already have a .env file, copy the .env.example file to .env:
```bash
cp .env.example .env
```

Edit the .env file to configure your environment settings, such as database credentials.

Configure your database

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user_name
DB_PASSWORD=database_password
```
Generate the application key for laravel
```bash
php artisan key:generate
```
## 4. Database Migration and Seeding

Run the database migrations to set up the tables required by the application:
```bash
php artisan migrate
```

Run the seed if you want to populate the database with dummy data
```bash
php artisan db:seed
```

## 5. Set File Permissions

Make sure the web server have the enough permission for the laravel recommended folders
```bash
chmod -R 775 storage
```

## 6. Set Up the Web Server

For development and testing, you can use Laravel's built-in server:
```bash
php artisan serve
```

This will start the server at http://127.0.0.1:8000 and all APIs will be available at http://127.0.0.1:8000/api

## 7. Project Testing

Test the API endpoints using Postman or any other API testing tool. For detailed API documentation please continue with this documentation

Make sure the Laravel Passport is installed for the authentication
```bash
php artisan passport:install
```
Passport is installed and facing issue with Personal Access Client after migration, then create the client
```bash
php artisan passport:client --personal
```

---
# API Documentation

## Authentication

### 1. User Registration

- **Endpoint: POST** /api/register
- **Description:** Registers a new user. Use the token in the response for accessing the api with authentication.
- **Headers:**
    - Accept: application/json
- **Sample Request:**
    ```bash
    {
      "first_name": "John",
      "last_name": "Doe",
      "email": "john@mail.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```
- **Sample Response:** Success (201)
    ```bash
    {
      "user": 
            {
              "id": 14,
              "first_name": "John",
              "last_name": "Doe",
              "email": "johndoe@mail.com",
              "created_at": "2025-03-06T18:37:29.000000Z"
            },
      "token": "eyJ0eXAiOiJKV1QiijV1U-...   ...pxmdA6SN4SonjH5EBXrU"
    }
    ```

### 2. User Login

- **Endpoint: POST** /api/login
- **Description:** Users can Log in using their credentials. Use the token in the response for accessing the api with authentication.
- **Headers:**
    - Accept: application/json
- **Sample Request:**
    ```bash
    {
      "email": "john@mail.com",
      "password": "password",
    }
    ```
- **Sample Response:** Success (200)
    ```bash
    {
      "user": 
            {
              "id": 14,
              "first_name": "John",
              "last_name": "Doe",
              "email": "johndoe@mail.com",
              "created_at": "2025-03-06T18:37:29.000000Z"
            },
      "token": "eyJ0eXAiOiJKV1QiijV1U-...   ...pxmdA6SN4SonjH5EBXrU"
    }
    ```
### 2. User Logout

- **Endpoint: POST** /api/logout
- **Description:** Log out from the user account
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (200)
    ```bash
    {
        "message": "Successfully Logged Out"
    }
    ```

---

## Attributes

### 1. Read All Attributes

- **Endpoint: GET** /api/attribute
- **Description:** List all attributes
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
    {
        "data": [
            {
                "id": 1,
                "name": "department",
                "type": "text"
            },
            {
                "id": 2,
                "name": "start_date",
                "type": "date"
            }
        ]
    }
    ```
### 2. Create Attribute

- **Endpoint: POST** /api/attribute
- **Description:** Create New Attribute
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
    {
      "name": "Department",
      "type": "text", // Only allowed [date, text, number, select]
    }
    ```
- **Sample Response:** Success (201)
    ```bash
    {
        "data": {
            "id": 1,
            "name": "Department",
            "type": "text"
        }
    }
    ```

### 3. Read Single Attribute

- **Endpoint: GET** /api/attribute/{id}
- **Description:** Get details of a single attribute
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
    {
        "data": {
            "id": 1,
            "name": "Department",
            "type": "text"
        }
    }
    ```

### 4. Update Attribute

- **Endpoint: PUT** /api/attribute/{id}
- **Description:** Update an attribute. If the field is mandatory it will be marked in the request.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
    {
      "name": "Address", 
      "type": "text", 
    }
    ```
- **Sample Response:** Success (201)
    ```bash
    {
        "data": {
            "id": 1,
            "name": "Address",
            "type": "text"
        }
    }
    ```

### 5. Delete Attribute

- **Endpoint: DELETE** /api/attribute/{id}
- **Description:** Delete Attribute
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
    {
        "message": "Attribute deleted successfully."
    }
    ```

---
## User

### 1. Read All Users

- **Endpoint: GET** /api/user
- **Description:** List all users
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
    {
        "data": [
            {
                "id": 4,
                "first_name": "Jordi",
                "last_name": "Haley",
                "email": "treynolds@example.com",
                "created_at": "2025-03-05T19:53:37.000000Z"
            },
            {
                "id": 5,
                "first_name": "Virginia",
                "last_name": "Gerlach",
                "email": "kirlin.dale@example.com",
                "created_at": "2025-03-05T19:53:37.000000Z"
            },
        ]
    }
    ```
### 2. Create User

- **Endpoint: POST** /api/user
- **Description:** Create New User
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
          "first_name": "John",
          "last_name": "Doe",
          "email": "john@mail.com",
          "password": "password",
          "password_confirmation": "password"
        }
    ```
- **Sample Response:** Success (201)
    ```bash
           {
                "data": {
                    "id": 1,
                    "first_name": "John",
                    "last_name": "Doe",
                    "email": "john@mail.com",
                    "created_at": "2025-03-06T19:20:26.000000Z"
                }
            }
    ```

### 3. Read Single User

- **Endpoint: GET** /api/user/{id}
- **Description:** Get details of a single user
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
           {
                "data": {
                    "id": 1,
                    "first_name": "John",
                    "last_name": "Doe",
                    "email": "john@mail.com",
                    "created_at": "2025-03-06T19:20:26.000000Z"
                }
            }
    ```

### 4. Update User

- **Endpoint: PUT** /api/user/{id}
- **Description:** Update user. If the field is mandatory it will be marked in the request. If you are changing password then password_confirmation field must be filled.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
            "first_name": "John",
            "last_name": "Bosco",
            "email": "john@mail.com",
            "password": "password",
            "password_confirmation": "password"
        }
    ```
- **Sample Response:** Success (201)
    ```bash
          "data": {
                "id": 1,
                "first_name": "John",
                "last_name": "Bosco",
                "email": "john@mail.com",
                "created_at": "2025-03-06T19:20:26.000000Z"
            }
    ```

### 5. Delete User

- **Endpoint: DELETE** /api/user/{id}
- **Description:** Delete User
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "message": "User Deleted"
        }
    ```
---

## Project

### 1. Read All Projects

- **Endpoint: GET** /api/project
- **Description:** List all Projects
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "data": [
                {
                    "id": 1,
                    "name": "Hessel-Turcotte",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z",
                    "attributes": [
                        {
                            "id": 1,
                            "name": "department",
                            "type": "text",
                            "value": "Product"
                        },
                        {
                            "id": 2,
                            "name": "start_date",
                            "type": "date",
                            "value": "2025-01-16"
                        },
                        {
                            "id": 3,
                            "name": "end_date",
                            "type": "date",
                            "value": "2025-03-29"
                        }
                    ]
                },
                {
                    "id": 2,
                    "name": "Good Name",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-06T09:13:56.000000Z",
                    "attributes": []
                },
            ]
        }
    ```
### 2. Create Project

- **Endpoint: POST** /api/project
- **Description:** Create New Project. You can assign multiple users to the single project creation time using array field users. If the array is empty the project will be only assigned to the logged in user.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
          "name": "Project Name",
          "status": 1, // Boolean Value
          "users": [1, 2, 3] // Ids of the other users
          "attributes_values": // Array of attributes
              [
                {
                    "attribute_id":1, // Each attribute have one attribute id 
                    "value": "HR" // Value for the attribute
                },
                {
                    "attribute_id":2,
                    "value": "2025-01-05"
                },
              ]
        }
    ```
- **Sample Response:** Success (201)
    ```bash
           {
            "data": {
                "id": 1,
                "name": "Hessel-Turcotte",
                "status": 1,
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z",
                "users": [
                    {
                        "id": 3,
                        "first_name": "Tyree",
                        "last_name": "Quitzon",
                        "email": "kirk.buckridge@example.com",
                        "created_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "timesheets": [
                    {
                        "id": 4,
                        "task_name": "Aspernatur ducimus rerum.",
                        "date": "2025-02-03",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                    {
                        "id": 9,
                        "task_name": "Facilis molestiae et architecto.",
                        "date": "2025-02-15",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "attributes": [
                    {
                        "id": 1,
                        "name": "department",
                        "type": "text",
                        "value": "Product"
                    },
                    {
                        "id": 2,
                        "name": "start_date",
                        "type": "date",
                        "value": "2025-01-16"
                    },
                ]
            }
        }
    ```

### 3. Read Single Project

- **Endpoint: GET** /api/project/{id}
- **Description:** Get details of a single project
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "name": "Hessel-Turcotte",
                "status": 1,
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z",
                "users": [
                    {
                        "id": 3,
                        "first_name": "Tyree",
                        "last_name": "Quitzon",
                        "email": "kirk.buckridge@example.com",
                        "created_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "timesheets": [
                    {
                        "id": 4,
                        "task_name": "Aspernatur ducimus rerum.",
                        "date": "2025-02-03",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                    {
                        "id": 9,
                        "task_name": "Facilis molestiae et architecto.",
                        "date": "2025-02-15",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "attributes": [
                    {
                        "id": 1,
                        "name": "department",
                        "type": "text",
                        "value": "Product"
                    },
                    {
                        "id": 2,
                        "name": "start_date",
                        "type": "date",
                        "value": "2025-01-16"
                    },
                ]
            }
        }
    ```

### 4. Update Project

- **Endpoint: PUT** /api/project/{id}
- **Description:** Update Project. If the field is mandatory it will be marked in the request. If you are changing password then password_confirmation field must be filled.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
          "name": "Project Name",
          "status": 1, // Boolean Value
          "users": [1, 2, 3] // Ids of the other users
          "attributes_values": // Array of attributes
              [
                {
                    "attribute_id":1, // Each attribute have one attribute id 
                    "value": "HR" // Value for the attribute
                },
                {
                    "attribute_id":2,
                    "value": "2025-01-05"
                },
              ]
        }
    ```
- **Sample Response:** Success (201)
    ```bash
           {
            "data": {
                "id": 1,
                "name": "Hessel-Turcotte",
                "status": 1,
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z",
                "users": [
                    {
                        "id": 3,
                        "first_name": "Tyree",
                        "last_name": "Quitzon",
                        "email": "kirk.buckridge@example.com",
                        "created_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "timesheets": [
                    {
                        "id": 4,
                        "task_name": "Aspernatur ducimus rerum.",
                        "date": "2025-02-03",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                    {
                        "id": 9,
                        "task_name": "Facilis molestiae et architecto.",
                        "date": "2025-02-15",
                        "hours": 6,
                        "user": {
                            "id": 9,
                            "first_name": "Fausto",
                            "last_name": "Schneider",
                            "email": "nakia82@example.com",
                            "created_at": "2025-03-05T19:53:37.000000Z"
                        },
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                ],
                "attributes": [
                    {
                        "id": 1,
                        "name": "department",
                        "type": "text",
                        "value": "Product"
                    },
                    {
                        "id": 2,
                        "name": "start_date",
                        "type": "date",
                        "value": "2025-01-16"
                    },
                ]
            }
        }
    ```

### 5. Delete Project

- **Endpoint: DELETE** /api/project/{id}
- **Description:** Delete Project
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "message": "Project deleted"
        }
    ```
---

## Timesheet

### 1. Read All Timesheets

- **Endpoint: GET** /api/timesheet
- **Description:** List all Timesheets
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
        "data": 
            [
                {
                    "id": 1,
                    "task_name": "Nisi voluptate fugiat fugiat quis.",
                    "date": "2025-02-18",
                    "hours": 6,
                    "user": {
                        "id": 7,
                        "first_name": "Providenci",
                        "last_name": "Rempel",
                        "email": "georgiana.larkin@example.net",
                        "created_at": "2025-03-05T19:53:37.000000Z"
                    },
                    "project": {
                        "id": 6,
                        "name": "Cummerata-Koelpin",
                        "status": 1,
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                {
                    "id": 3,
                    "task_name": "Ut sint earum saepe.",
                    "date": "2025-02-05",
                    "hours": 2,
                    "user": {
                        "id": 7,
                        "first_name": "Providenci",
                        "last_name": "Rempel",
                        "email": "georgiana.larkin@example.net",
                        "created_at": "2025-03-05T19:53:37.000000Z"
                    },
                    "project": {
                        "id": 6,
                        "name": "Cummerata-Koelpin",
                        "status": 1,
                        "created_at": "2025-03-05T19:53:37.000000Z",
                        "updated_at": "2025-03-05T19:53:37.000000Z"
                    },
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-06T09:21:59.000000Z"
                },
            ]
        }
    ```
### 2. Create Timesheet

- **Endpoint: POST** /api/timesheet
- **Description:** Create New Timesheet. Using this API any user can create the timesheet for other users.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
            "task_name": "Nisi voluptate fugiat fugiat quis.",
            "date": "2025-02-18", 
            "hours": 6, // Value between 1- 24
            "user_id": 1, // Id of the User
            "project_id": 1 // Id of the Project
        }
    ```
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "task_name": "Nisi voluptate fugiat fugiat quis.",
                "date": "2025-02-18",
                "hours": 6,
                "user": {
                    "id": 7,
                    "first_name": "Providenci",
                    "last_name": "Rempel",
                    "email": "georgiana.larkin@example.net",
                    "created_at": "2025-03-05T19:53:37.000000Z"
                },
                "project": {
                    "id": 6,
                    "name": "Cummerata-Koelpin",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z"
            }
        }
    ```

### 3. Read Single Timesheet

- **Endpoint: GET** /api/timesheet/{id}
- **Description:** Get details of a single Timesheet
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "task_name": "Nisi voluptate fugiat fugiat quis.",
                "date": "2025-02-18",
                "hours": 6,
                "user": {
                    "id": 7,
                    "first_name": "Providenci",
                    "last_name": "Rempel",
                    "email": "georgiana.larkin@example.net",
                    "created_at": "2025-03-05T19:53:37.000000Z"
                },
                "project": {
                    "id": 6,
                    "name": "Cummerata-Koelpin",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z"
            }
        }
    ```

### 4. Update Timesheet

- **Endpoint: PUT** /api/timesheet/{id}
- **Description:** Update Timesheet.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
            "task_name": "Nisi voluptate fugiat fugiat quis.",
            "date": "2025-02-18", 
            "hours": 6, // Value between 1- 24
            "user_id": 1, // Id of the User
            "project_id": 1 // Id of the Project
        }
    ```
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "task_name": "Nisi voluptate fugiat fugiat quis.",
                "date": "2025-02-18",
                "hours": 6,
                "user": {
                    "id": 7,
                    "first_name": "Providenci",
                    "last_name": "Rempel",
                    "email": "georgiana.larkin@example.net",
                    "created_at": "2025-03-05T19:53:37.000000Z"
                },
                "project": {
                    "id": 6,
                    "name": "Cummerata-Koelpin",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z"
            }
        }
    ```

### 5. Delete Timesheet

- **Endpoint: DELETE** /api/timesheet/{id}
- **Description:** Delete Timesheet
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Response:** Success (201)
    ```bash
        {
            "message": "Timesheet deleted"
        }
    ```

### 6. Create Timesheet only for the users have access to the Project

- **Endpoint: POST** /api/project/{project_id}/timesheet/
- **Description:** Create New Timesheet.This function will check the authorized user have access to the Project and create the Timesheet.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
            "task_name": "Nisi voluptate fugiat fugiat quis.",
            "date": "2025-02-18", 
            "hours": 6, // Value between 1- 24
            "project_id": 1 // Id of the Project
        }
    ```
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "task_name": "Nisi voluptate fugiat fugiat quis.",
                "date": "2025-02-18",
                "hours": 6,
                "user": {
                    "id": 7,
                    "first_name": "Providenci",
                    "last_name": "Rempel",
                    "email": "georgiana.larkin@example.net",
                    "created_at": "2025-03-05T19:53:37.000000Z"
                },
                "project": {
                    "id": 6,
                    "name": "Cummerata-Koelpin",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z"
            }
        }
    ```

### 7. Update Timesheet only for the users have access to the Project

- **Endpoint: POST** /api/project/{project_id}/timesheet/{timesheet_id}
- **Description:** Update Timesheet.This function will check the authorized user have access to the Project and Update the Timesheet.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request:**
    ```bash
        {
            "task_name": "Nisi voluptate fugiat fugiat quis.",
            "date": "2025-02-18", 
            "hours": 6, // Value between 1- 24
            "project_id": 1 // Id of the Project
        }
    ```
- **Sample Response:** Success (201)
    ```bash
        {
            "data": {
                "id": 1,
                "task_name": "Nisi voluptate fugiat fugiat quis.",
                "date": "2025-02-18",
                "hours": 6,
                "user": {
                    "id": 7,
                    "first_name": "Providenci",
                    "last_name": "Rempel",
                    "email": "georgiana.larkin@example.net",
                    "created_at": "2025-03-05T19:53:37.000000Z"
                },
                "project": {
                    "id": 6,
                    "name": "Cummerata-Koelpin",
                    "status": 1,
                    "created_at": "2025-03-05T19:53:37.000000Z",
                    "updated_at": "2025-03-05T19:53:37.000000Z"
                },
                "created_at": "2025-03-05T19:53:37.000000Z",
                "updated_at": "2025-03-05T19:53:37.000000Z"
            }
        }
    ```
---

## Filtering

### 1.Project Filters

- **Endpoint: GET** /api/project
- **Description:** Additional filters for the Project.
- **Headers:**
    - Accept: application/json
    - Authorization: Bearer {token}
- **Sample Request 1:** - Simple filters will search with the key as the **field name** and value as the **search keyword**. In this method only **=** operation is possible.

    ```bash
        {
            "filters": [
                "name" : "Project Name",
                "department": "HR",
                "start_date" : "2025-03-07"
            ] 

        }
    ```
- **Sample Request 2:** - This options will provide some additional search functionality on the project and attribute values.  Will search for all projects with start_date before 2025-03-07 and department name is HR.
    ```bash
        {
            "filters": [
                "start_date" : 
                    [
                        "operation" : "<", // available operations are <, >, LIKE, = 
                        "value" : "2025-03-07"
                    ],
                "department": "HR", 
            ] 

        }
    ```
- **Sample Request 3:** - This option will do multiple operations
    ```bash
        {
            "filters": [
                "start_date" : 
                    [
                        "operation" : "<", // available operations are <, >, LIKE, = 
                        "value" : 2025-03-07
                    ],
                "name": 
                    [
                        "operation" : "LIKE",
                        "value" : "Development"
                    ]
                
            ] 

        }
    ```
- ** Response:** Success (201)
  Response will be same as the Project Listing API

---

## Test Credentials

You can use this default test user 

Email : **test@example.com**

Password: **password**
