# Cat Breeds
The purpose of the API is to return information about different species of cats. For this, a database was created. Whenever a new request to the API is received, a validation of the data of this request is performed and if the request presents all the necessary data, and a search in the local bank. If the species exists in our local bank the information is returned by the API, if it does not exist a search in an external API is done (https://thecatapi.com/) and if there is a species the same is added in the database and the information is returned.


# Flow Diagram
https://drive.google.com/open?id=1UWCirBCBHH7-dYORaKa2kEvXgRnuT-IS


# Install

The application has been developed using the Laravel framework and Mysql so some installations may be necessary. The requirements are:
- PHP >= 7.1.3
- Mysql >= 5.7
- Composer
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

After the installation, just download the project enter the terminal of the project folder and type:
```
composer install
```
It is necessary to configure the .env of the application mainly the database.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## Tests

In the project folder there is a file (Insomnia_CatBreeds.json) that was used to test the API requests.