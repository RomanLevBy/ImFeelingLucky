# ImFeelingLucky

### System requirements

For local application starting (for development) make sure that you have locally installed next applications:

- `docker >= 18.09.4` _(install: `curl -fsSL get.docker.com | sudo sh`)_
- `sudo usermod -aG docker $USER` (linux only)
- `newgrp docker` (linux only)
- `docker-compose >= 1.24` _(for install: `apt install docker-compose`)_
- `make >= 4.2.1` _(install: `apt-get install make`)_

### Used services

Declaration of all services can be found into `./docker-compose.yml` file.

## Fast application starting

### 0. Clone project
```bash
$ git clone https://github.com/RomanLevBy/ImFeelingLucky.git && cd ImFeelingLucky
```

### 1. Initialize ENV files
```bash
$ cp .env.example .env
```

### 2. Setup project

1. Set variables in **.env** file
    - WWWGROUP _(to get run in console: `id -g ${USER}`)_
    - WWWUSER _(to get run in console: `id -u ${USER}`)_

### 3. Run project
```bash
make up
```
After application starting you can open [http://localhost:8085](http://localhost:8085/) in your browser.
