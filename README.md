## Cashu

### Requirement

- Write a PHP Code to list your google drive files data by using Google API's.

### Class diagram

![Class Diagram](diagram.png)

## End point
- A REST API application to get transactions from multiple provider with criteria

- GET `[base-url]/api/driver/list`
- Response 
```json
{
    "files": [
        {
            "id": "0B6mu60ho67DaLLFoRUO5ueHh6YUg2QjFrNDVtdzJzTV81U2JV",
            "name": "CROPPED-IMG_92020.JPG",
            "mimeType": "image/jpeg",
            "downloadLink": "https://drive.google.com/uc?id=0B6mud60ho67DaLsoRU5ueHhs6YUg2QjFrNDVtdzJzTV81U2JV&export=download",
            "size": "106496"
        }, {
            "id": "0B6pu60ho6aTFoRU5ueHh6YUg2QjFrNDVtdzJzTV81U2JV",
            "name": "Resume.pdf",
            "mimeType": "application/pdf",
            "downloadLink": "https://drive.google.com/uc?id=0B37Ea1sIdztZV0soiTlzNHNqN2c&export=download",
            "size": "106496"
        }
    ]
}
```

### Installing

- Run `docker-compose build`
- Run `docker-compose run php composer install` to install the dependencies.
- Run `docker-compose up`

### Running the tests

- Run `docker-compose run php /www/vendor/bin/phpunit`

### Built With

* [PHP7.2](http://php.net)
* [Symfony4](http://www.symfony.com) 
* [jms/serializer](https://jmsyst.com/libs/serializer) - Library for (de-)serializing data of any complexity; supports XML, JSON

Please read the following docs:
- [Installing the application](docs/install.md)
