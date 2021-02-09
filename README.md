# Glofox Test!

## Author

Kilderson Sena - dersonsena@gmail.com

## Instructions for run the project

### Clone

Clone the project to your machine using the command:

```bash
$ git clone git@github.com:dersonsena/glofox-test.git
```

### Environment variables
Make a copy of the `.env.sample` file. To do this, open your terminal and run:

```bash
$ cp .env.sample .env
```

You can place the environment settings in the `.env` file as follows (note that the sample file is ready for basic use):

```
# ---------
# Docker
# ---------
PROJECT_NAME=glofox
DOCKER_APP_PORT=8000
DOCKER_MYSQL_PORT=3306

# ---------
# APPLICATION
# ---------
APP_ENV=dev

# ---------
# Database
# ---------
DB_HOST=glofox-db
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=secret
DB_DATABASE=glofox
```

### Run app
To start your application and initialize your containers, just run the following command:

```bash
$ make install
$ make up
```

If you have set the `DOCKER_APP_PORT` environment variable to` 8000`, you can access your application via the following URL:

```
http://localhost:8000
```
