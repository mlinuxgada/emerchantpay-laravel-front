# Golang RSS Reader service and Laravel RSS Reader application

If you've ever used Google Reader, Feedly, Digg or any other RSS reader, then you must be familiar with what RSS readers generally do. For the sake of assignment

purpose, please create an RSS reader by taking the following steps:

    1. Create a Golang RSS Reader package, which can parse asynchronous multiple RSS feeds.

    2. Create a Golang Rss Reader service that uses the RSS package

    3. Create a Laravel application that contains the following features:

        3.1. Store, manage and display the RSS URLs.

        3.2. Store, manage and display the RSS posts.

        3.3. Requests the Golang RSS Reader to parse a set of URLs.

## RSS Reader service



### RSS Reader package

Use the latest stable version of Go . The package must have only exportable type RssItem and method Parse that:

    1. Takes an array of URLs.

    2. Parses asynchronously their feed.

    3. Returns an array of RssItem generated from all provided RSS posts.

    ````

        type RssItem struct{

            Title string

            Source string

            SourceURL string

            Link string

            PublishDate time.Time

            Description string

        }



    ````

Cover all changes with tests.

Add a README file with an explanation how the package should be installed and used.





### RSS Reader service

Use the latest stable version of Go in order to implement service that handles JSON API requests that contain URLs. Using the already created RSS Reader package,

it will parse the URLs and return as JSON in the response the following structure

```

    {

        "items": [

            {

                "title": "<ProperValue>",

                "source": "<ProperValue>",

                "source_url": "<ProperValue>",

                "link": "<ProperValue>",

                "publish_date": "<ProperValue>",

                "description": "<ProperValue>"

            }

            ....

        ]

    }



```

Add a README file with an explanation of set up and usage of the application.



## Laravel RSS Reader application

1. Use the latest stable Laravel version.

2. View engine and Frontend Framework.

    2.1. Use Blade view engine.

    2.2. Bootstrap.

3. Create CRUD endpoint and UI for RSS URLs.

4. Create a posts preview page.

    4.1. Fetch and display latest posts.

    4.2. Sort by date with the most recent first.

    4.3. Be able to filter posts by RSS feed, Date of creation and Title.

    4.4. Display the titles only, clicking on a title will open original article page in new tab/window.

5. Background job that uses the Golang RSS Reader service to get and parse the posts.

6. Cover all changes with tests.

7. Add integration tests.






### Bonus points

We will give bonus points for the following: - if the communication between Golang RSS Reader service and Laravel RSS Reader application is via RabbitMQ or

another messaging broker. - if RSS Reader service implements some authorization for the requests, using JWT for example. - if Laravel RSS Reader application uses

React. - if both PHP application and Go service are dockerized.






### Additional Comments

1. Initial commit with all changes not directly related to the task - .gitignore file, etc.

2. All subsequent commits should be logically organized reflecting the steps you've taken developing the application - neither one large commit with all changes

nor a multitude of smaller commits for every little tiny change.

3. Document your code where needed and add a short README.




## Installation

Dev/local install:



1. clone the git repo to the current webroot 

2. run
```
$ composer install
```
2. if started locally, copy env.example into .env

3. make needed changes into env vars

3.1 pay attention to db related ones and the api, specially:
```
RSS_API_URL=http://172.16.1.109:8081/api/v1/rss/parse
JWT_SIGNING_KEY=ILoisPWWwQDxZpdNroP1U4lzVpFVYeP6
```
4. run migrations:
```
$ php artisan migrate
```
5. run with :
```

$ php artisan serve -
```
6. start queue workers work:
```
$ php artisan queue:work
```

!!! IMPORTANT - the number of parallel processing is defined from the number of workers started.

## Testing

Make sure the app is properly installed, env vars adjusted and the app is runnig

Currently using Laravel Dusk, to test browser req/resp functionality.

Running all tests is just by:
```
$ php artisan dusk -v
```

Sometimes, because of changes here and there theres several places of caching. So, in that case, better run:
```
$ php artisan optimize && php artisan dusk -v
```

## Dokerization
Important: when working with docker-compose, define DB_HOST=db into env file!!!

Go to where emerchantpay app is cloned, and run using docker-compose single command:
 ```
 $  docker-compose up
 ```

 Then run migrations:
 ```
 $ docker-compose exec main php ./artisan migrate 
 ```

Open http://localhost:8000

## Makefile
Instead of remembering all this, simplest way to manage frontend app is:
 - when wanna start it, run:
 ```
 $ make start
 ```
 - if for some reason wanna stop it, run:
 ```
 $ make stop
 ```
 - for restart/reload, run:
 ```
 $ make restart
 ```
 - for running migrations, eg upping the db, run:
 ```
 $ make migrate
 ```
