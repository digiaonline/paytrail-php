paytrail-php
============

[![Build Status](https://travis-ci.org/nordsoftware/paytrail-php.svg?branch=master)](https://travis-ci.org/nordsoftware/paytrail-php) [![Coverage Status](https://coveralls.io/repos/hugovk/paytrail-php/badge.png?branch=coveralls)](https://coveralls.io/r/hugovk/paytrail-php?branch=coveralls)

Paytrail REST client for PHP.

# Usage

```php
<?php

require(__DIR__ . '/vendor/autoload.php');

use Paytrail\Object\UrlSet;
use Paytrail\Object\Address;
use Paytrail\Object\Contact;
use Paytrail\Object\Payment;
use Paytrail\Object\Product;
use Paytrail\Http\Client;

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

# Confirming a payment

```php

<?php
$client = new Client('13466', '6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ');
$client->connect();
if ($client->validateChecksum($_GET["RETURN_AUTHCODE"], $_GET["ORDER_NUMBER"], $_GET["TIMESTAMP"], $_GET["PAID"], $_GET["METHOD"])) {
    // Payment receipt is valid
    // If needed, the used payment method can be found from the variable $_GET["METHOD"]
    // and order number for the payment from the variable $_GET["ORDER_NUMBER"]
}
else {
    // Payment receipt was not valid, possible payment fraud attempt
}

```

# License
MIT. See [LICENSE](LICENSE).
