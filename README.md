<p style="text-align: center;">
<img alt="logo" src="https://raw.githubusercontent.com/alvaroassmus/mendATC/master/docs/assets/radar-svgrepo-com.svg" width="200">
</p>
<h1 style="text-align: center;">mendATC Air Traffic Control</h1>

## About The mendATC Project

Using LARAVEL framework with REDIS, I develop an Air Traffic Control system (ATCS) that meets the requirements listed in the requirements document (<a href="https://raw.githubusercontent.com/alvaroassmus/mendATC/master/docs/assets/requirements.pdf" target="_blank">download</a>). The ATCS will allow the queuing and dequeuing of aircraft (AC).

In this README file you will find an overview of how I distributed the diferent layers and the functionalities requested for the test.

You will also find the deployment instructions and artifacts list and description.

Welcome to mendATC.

**Eng Alvaro Assmus Nassar**<br/>
**alvaro.assmus@bairesdev.com**

## LAYERS

* **REST**
  
  This layer contains the REST API for the project, they are located in the <a href="https://github.com/alvaroassmus/mendATC/blob/master/routes/web.php" target="_blank">web.php</a> file. You can read each method documentation in the following list:
  - [Boot](https://github.com/alvaroassmus/mendATC/blob/master/docs/rest/boot.md)
  - [Enqueue](https://github.com/alvaroassmus/mendATC/blob/master/docs/rest/enqueue.md)
  - [Dequeue](https://github.com/alvaroassmus/mendATC/blob/master/docs/rest/dequeue.md)
  - [List](https://github.com/alvaroassmus/mendATC/blob/master/docs/rest/list.md)


* **LOGIC**
  
  The logic layer located in the <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Http/Controllers/AtcController.php" target="_blank">AtcController.php</a>. This class implements the <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Http/Controllers/AtcInterface.php" target="_blank">AtcInterface.php</a>,
  the interface is to guarantee the correct coding of the methods for the ATC logic layer.


* **DATA**
  
  The data layer located in the <a href="https://github.com/alvaroassmus/mendATC/tree/master/app/Models/Atc" target="_blank">Model folder</a> contains: 
  - <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Models/Atc/Aircraft.php" target="_blank">Aircraft DTO</a>: Used to transport an aircraft from layer to layer.
  - <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Models/Atc/AtcQueueInterface.php" target="_blank">AtcQueueInterface</a>: Created to define the methods for new implementations if the storage changes, for this example I used REDIS, but if it has to change to MYSQL or JSON files, the developer must implement these methods to maintain the project scope.
  - <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Models/Atc/AtcRedisQueue.php" target="_blank">AtcRedisQueue</a>: It centralizes the REDIS queues implementation for the project.
  - REDIS: Used to store the queues, and the boot flag.

## Error handling

Laravel has the error handler, so I created a method to catch and process the errors of the project, this way the developer can use the TRY-CATCH sentence to control the errors that have to exist in the project. You can check the <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Http/Controllers/AtcController.php" target="_blank">AtcController.php</a> and, you will find that the methods have the TRY-CATCH block calling the Laravel <a href="https://github.com/alvaroassmus/mendATC/blob/master/app/Exceptions/Handler.php" target="_blank">Handler.php</a> with the processException method.

## Software requirements

- PHP (7.4.3)
- COMPOSER (1.10.1)
- NPM (7.20.0)
- REDIS (5.0.7)

## Deploying in localhost

  To deploy the project you must follow the next steps:
    
  1. Have the software requirements installed :P  
  2. Clone or download the project: https://github.com/alvaroassmus/mendATC.git
  3. Go to project folder and run `composer install`, be sure to have all the php dependencies required for laravel project or, it will fail. 
  4. Be sure to have the REDIS server up and running.
  5. Run `php artisan serve` command from terminal and go to the shown URL. Your server will be up and running.

## Unit Testing

// TODO

## About the developer

Alvaro Assmus Nassar (me) - fullstack software engineer with more than 14 years of experience developing software, also a dad and a musician. I love life and learning. 
