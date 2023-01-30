# Log Form

A PHP application that allows users to submit log entries through a form and stores them in a MySQL database. The application is built using three Docker containers, which are:

-   Application
-   Database
-   Form Data

## Requirements

-   Docker
-   Docker Compose

## Getting Started

Clone the repository to your local machine:

bashCopy code

`git clone https://github.com/<your_username>/log-form.git` 

Change into the project directory:

bashCopy code

`cd log-form` 

Create a copy of the `docker.env.example` file and rename it to `docker.env`:

bashCopy code

`cp docker.env.example docker.env` 

Edit the `docker.env` file to add your desired environment variables.

Build the Docker containers using the provided `build.sh` script:

bashCopy code

`./build.sh` 

The application should now be up and running. To access the log form, visit `http://localhost:8080` in your web browser.

## Destroying the Containers

To stop and remove the containers, run the provided `destroy.sh` script:

bashCopy code

`./destroy.sh` 

## Configuration

The application and its components are configured using the provided `docker-compose.yml` and `docker.env` files. You can edit these files to change the configuration of the containers and their behavior.