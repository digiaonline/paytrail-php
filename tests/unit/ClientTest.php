<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Paytrail\Http\Client;
use Paytrail\Object\Address;
use Paytrail\Object\Contact;
use Paytrail\Object\Payment;
use Paytrail\Object\Product;
use Paytrail\Object\UrlSet;

/**
 * Class ClientTest
 */
class ClientTest extends \Codeception\TestCase\Test
{

    /**
     * @var \CodeGuy
     */
    protected $codeGuy;

    /**
     * Test connection.
     */
    public function testConnect()
    {
        $client = $this->makeClient();
        $client->connect();
        $this->assertNotNull($client->getClient());
    }

    /**
     * Test payment processing.
     *
     * @throws \Paytrail\Exception\PaymentFailed
     */
    public function testProcessPayment()
    {
        $client = $this->makeClient();
        $client->connect();
        $payment = $this->makePayment();
        $result = $client->processPayment($payment);
        $this->assertEquals(1, $result->getOrderNumber());
    }

    /**
     * Test payment checksum validation on successful transaction.
     */
    public function testValidateSuccessChecksum()
    {
        $client = $this->makeClient();
        $client->connect();

        $orderNumber = 1;
        $timestamp = 1459256594;
        $paid = '840a0b45ee';
        $method = 1;
        $returnAuthCode = '33BC65BC7C48B66B3BD765A07E910BCE';

        $this->assertTrue($client->validateChecksum($returnAuthCode, $orderNumber, $timestamp, $paid, $method));
    }

    /**
     * Validate checksum validation on failed trasaction.
     */
    public function testValidateFailureChecksum()
    {
        $client = $this->makeClient();
        $client->connect();

        $orderNumber = 1;
        $timestamp = 1459256669;
        $returnAuthCode = '076F5C44FF72EBCE892E9B32FD761597';

        $this->assertTrue($client->validateChecksum($returnAuthCode, $orderNumber, $timestamp));
    }

    /**
     * Test setting of API version.
     *
     * @throws \Paytrail\Exception\ApiVersionNotSupported
     */
    public function testSetApiVersion()
    {
        $client = $this->makeClient();
        $client->setApiVersion(1);
    }

    /**
     * Creates the UrlSet.
     *
     * @return UrlSet
     */
    protected function makeUrlSet()
    {
        $urlSet = new UrlSet;
        $urlSet->configure(array(
            'successUrl'      => 'https://www.demoshop.com/sv/success',
            'failureUrl'      => 'https://www.demoshop.com/sv/failure',
            'notificationUrl' => 'https://www.demoshop.com/sv/notify',
            'pendingUrl'      => 'https://www.demoshop.com/sv/pending',
        ));

        return $urlSet;
    }

    /**
     * Creates an Address.
     *
     * @return Address
     */
    protected function makeAddress()
    {
        $address = new Address;
        $address->configure(array(
            'streetAddress' => 'Test street 1',
            'postalCode'    => '12345',
            'postOffice'    => 'Helsinki',
            'countryCode'   => 'FI',
        ));

        return $address;
    }

    /**
     * Creates a Contact.
     *
     * @return Contact
     */
    protected function makeContact()
    {
        $contact = new Contact;
        $contact->configure(array(
            'firstName'   => 'Test',
            'lastName'    => 'Person',
            'email'       => 'test.person@demoshop.com',
            'phoneNumber' => '040123456',
            'companyName' => 'Demo Company Ltd',
            'address'     => $this->makeAddress(),
        ));

        return $contact;
    }

    /**
     * Creates a Payment.
     *
     * @return Payment
     *
     * @throws \Paytrail\Exception\TooManyProducts
     */
    protected function makePayment()
    {
        $payment = new Payment;
        $payment->configure(array(
            'orderNumber' => 1,
            'urlSet'      => $this->makeUrlSet(),
            'contact'     => $this->makeContact(),
            'locale'      => Payment::LOCALE_ENUS,
        ));
        $payment->addProduct($this->makeProduct());

        return $payment;
    }

    /**
     * Creates a Product.
     *
     * @return Product
     */
    protected function makeProduct()
    {
        $product = new Product;
        $product->configure(array(
            'title'    => 'Test product',
            'code'     => '01234',
            'amount'   => 1.00,
            'price'    => 19.90,
            'vat'      => 23.00,
            'discount' => 0.00,
            'type'     => Product::TYPE_NORMAL,
        ));

        return $product;
    }

    /**
     * Creates a Client.
     *
     * @return Client
     */
    protected function makeClient()
    {
        return new Client();
    }
}
