paytrail-php
============

[![Build Status](https://travis-ci.org/nordsoftware/paytrail-php.svg?branch=master)](https://travis-ci.org/nordsoftware/paytrail-php)

Paytrail REST client for PHP.

# Usage

```php
<?php

require(__DIR__ . '/vendor/autoload.php');

use NordSoftware\Paytrail\Object\UrlSet;
use NordSoftware\Paytrail\Object\Address;
use NordSoftware\Paytrail\Object\Contact;
use NordSoftware\Paytrail\Object\Payment;
use NordSoftware\Paytrail\Object\Product;
use NordSoftware\Paytrail\Http\Client;

$urlSet = new UrlSet;
$urlSet->configure(array(
  'successUrl'      => 'https://www.demoshop.com/sv/success',
  'failureUrl'      => 'https://www.demoshop.com/sv/failure',
  'notificationUrl' => 'https://www.demoshop.com/sv/notify',
  'pendingUrl'      => 'https://www.demoshop.com/sv/pending',
));

$address = new Address;
$address->configure(array(
  'streetAddress'   => 'Test street 1',
  'postalCode'      => '12345',
  'postOffice'      => 'Helsinki',
  'countryCode'     => 'FI',
));

$contact = new Contact;
$contact->configure(array(
  'firstName'       => 'Test',
  'lastName'        => 'Person',
  'email'           => 'test.person@demoshop.com',
  'phoneNumber'     => '040123456',
  'companyName'     => 'Demo Company Ltd',
  'address'         => $address,
));

$payment = new Payment;
$payment->configure(array(
  'orderNumber'     => 1,
  'urlSet'          => $urlSet,
  'contact'         => $contact,
  'locale'          => Payment::LOCALE_ENUS,
));

$product = new Product;
$product->configure(array(
  'title'           => 'Test product',
  'code'            => '01234',
  'quantity'        => 1.00,
  'price'           => 19.90,
  'vat'             => 23.00,
  'discount'        => 0.00,
  'type'            => Product::TYPE_NORMAL,
));

$payment->addProduct($product);

$client = new Client('13466', '6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ');
$client->connect();
try {
  $result = $client->processPayment($payment);
} catch (Exception $e) {
  die('Paytrail payment failed: ' . $e->getMessage());
}

header('Location: ' . $result->getUrl());
```
