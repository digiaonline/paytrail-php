<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Codeception\Util\Stub;
use NordSoftware\Paytrail\Http\Client;
use NordSoftware\Paytrail\Object\Address;
use NordSoftware\Paytrail\Object\Contact;
use NordSoftware\Paytrail\Object\Payment;
use NordSoftware\Paytrail\Object\Product;
use NordSoftware\Paytrail\Object\UrlSet;

class ClientTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    public function testConnect()
    {
        $client = $this->makeClient();
        $client->connect();
        $this->assertNotNull($client->getClient());
    }

    public function testProcessPayment()
    {
        $client = $this->makeClient();
        $client->connect();
        $payment = $this->makePayment();
        $client->processPayment($payment);
    }

    public function testSetApiVersion()
    {
        $client = $this->makeClient();
        $client->setApiVersion(1);
    }

    protected function makeUrlSet()
    {
        $urlset = new UrlSet;
        $urlset->configure(array(
            'successUrl'      => 'https://www.demoshop.com/sv/success',
            'failureUrl'      => 'https://www.demoshop.com/sv/failure',
            'notificationUrl' => 'https://www.demoshop.com/sv/notify',
            'pendingUrl'      => 'https://www.demoshop.com/sv/pending',
        ));
        return $urlset;
    }

    protected function makeAddress()
    {
        $address = new Address;
        $address->configure(array(
            'streetAddress'   => 'Test street 1',
            'postalCode'      => '12345',
            'postOffice'      => 'Helsinki',
            'countryCode'     => 'FI',
        ));
        return $address;
    }

    protected function makeContact()
    {
        $contact = new Contact;
        $contact->configure(array(
            'firstName'       => 'Test',
            'lastName'        => 'Person',
            'email'           => 'test.person@demoshop.com',
            'phoneNumber'     => '040123456',
            'companyName'     => 'Demo Company Ltd',
            'address'         => $this->makeAddress(),
        ));
        return $contact;
    }

    protected function makePayment()
    {
        $payment = new Payment;
        $payment->configure(array(
            'orderNumber'     => 1,
            'urlSet'          => $this->makeUrlSet(),
            'contact'         => $this->makeContact(),
            'locale'          => Payment::LOCALE_ENUS,
        ));
        $payment->addProduct($this->makeProduct());
        return $payment;
    }

    protected function makeProduct()
    {
        $product = new Product;
        $product->configure(array(
            'title'           => 'Test product',
            'code'            => '01234',
            'amount'          => 1.00,
            'price'           => 19.90,
            'vat'             => 23.00,
            'discount'        => 0.00,
            'type'            => Product::TYPE_NORMAL,
        ));
        return $product;
    }

    protected function makeClient()
    {
        return new Client();
    }
}