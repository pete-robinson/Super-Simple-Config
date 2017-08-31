# Super-Simple-Config
## Introduction
A super-simple configuration manager that enables easy integration with YAML based configuration files.

Pass in the configuration YAML file location and the class will parse it and make its properties avaialble to you, with dot separated levels of nesting

## Usage
Create a new instance of the config class and load in the config

### Example YAML Config File

```yml
config:
  database:
    host: 127.0.0.1
    user: username
    password: password
    name: db_name
  api:
  	google:
		client_id: myclientid
		key: xxxxxxxxx
```

### Create a New Config Instance

```php
<?php
$file = realpath(__DIR__ . '/path/to/file.yml');
$config = new Config($file);
```

### Fetch Config Parameters

```php
<?php
echo $config->get('path.to.parameter');
```

### Example Based on Config File Above
```php
<?php
echo $config->get('config.database.host');
// returns 127.0.0.1

echo $config->get('config.api.google.client_id');
// returns 'myclientid'
```