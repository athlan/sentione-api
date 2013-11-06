sentione-api
============

This is a PHP 5.3+ API wrapper for the [SentiOne API](http://sentione.pl/)

* Author: [Piotr 'Athlan' Pelczar](http://athlan.pl)
* Created for project: [Fokus](http://getfokus.com)

---

##Requirements
* PHP 5.3+
* [CURL](http://php.net/manual/en/book.curl.php)
* API credentials. To obtain username and password, please [contact SentiOne developers](http://sentione.pl/kontakt).

##Installation

###Composer
Add the following package to `composer.json`:
```
"getfokus/sentione-api": "*"
```

##Basic usage

To call API just use method:
```
$response = $sentione->apiCall($action, array $params);
```

You will receive the `Response` object

###Example
```
<?php

$username = 'USERNAME';
$password = '*****';

$sentione = new SentioneApi\Client($username, $password);
$response = $sentione->apiCall('sources sentiment', [
	'keyword' => 'sentione',
]);

$data = $response->getData();
var_dump($data);

```
