# Downloader
Application that provides to download particular resource

### Description
You need to develop a web-application which will download particular resource by specified url. The same resources can be downloaded multiple times.
Url can be passed via web API method or with CLI command.
There should be a simple html page showing status of all jobs (for complete jobs there also should be an url to download target file). The same should be available via CLI command and web API.
It should save downloaded urls in storage configured in Laravel (local driver can be used). 

### Requirements

1. Laravel 5
2. PHP 7
3. any SQL DB

### Acceptance Criteria

- should use DB to persist task information
- should use job queue to download resources
- should use Laravel storage to store downloaded resources
- REST API method / CLI command / web page to enqueue url to download
- REST API method / CLI command / web page to view list of download tasks with statuses (pending/downloading/complete/error) and ability to download resource for completed tasks (url to resource in Laravel storage)
unit tests
- no paging nor css is required for html page
- no authentication/authorization (no separation by users)

## Deploy 

- `composer install`
- configure .env
- run following commands
- `php artisan migrate`
- `php artisan storage:link`
- `php artisan serve`
- `php artisan queue:work`

## Usage

Application provide to download resources by three ways:
- web interface
- console artisan command
- api

### Console

To run console command use:
- `php artisan download:resource {url}`
- `php artisan download:report {countItems}`

Example:
`php artisan download:report 5`

![console usage example](https://raw.githubusercontent.com/victoratsuta/downloader/master/markdown-images/Screenshot%20from%202018-10-20%2022-47-37.png "Logo Title Text 1")

### Web

Open main page, to get list of resources with additional info, and links to download.  
Example:

![web usage example](https://github.com/victoratsuta/downloader/blob/master/markdown-images/Screenshot%20from%202018-10-20%2022-58-58.png?raw=true "Logo Title Text 1")

Use form to input url with address to download.

### Api

Use `domain/api/add` link with `POST` request to add resource to download.
And `domain/api/list` to get list of resources in Json format.  
Example:
![web usage example](https://github.com/victoratsuta/downloader/blob/master/markdown-images/Screenshot%20from%202018-10-20%2023-00-12.png?raw=true "Logo Title Text 1")
  
## Test

Specify `TEST_URL_FILE` and `TEST_STORAGE_FILE` in .env, also don`t forget about db configs for testing.

Use `phpunit` or `./vendor/bin/phpunit` to run the tests.