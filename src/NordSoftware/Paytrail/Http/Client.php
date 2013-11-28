<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NordSoftware\Paytrail\Http;

use Guzzle\Http\Message\Response;
use NordSoftware\Paytrail\Common\Object;
use NordSoftware\Paytrail\Exception\PaymentFailed;
use NordSoftware\Paytrail\Exception\UnsupportedApiVersion;

class Client extends Object
{
    const API_ENDPOINT = 'https://payment.verkkomaksut.fi';

    /**
     * @var int
     */
    protected $apiVersion = 1;

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * @var string
     */
    private $_apiKey = '13466';

    /**
     * @var string
     */
    private $_apiSecret = '6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ';

    /**
     * @var \Guzzle\Http\Client
     */
    private $_client;

    /**
     * @var array
     */
    static $supportedApiVersions = array(1);

    /**
     * @param string $url
     */
    public function connect($url = self::API_ENDPOINT)
    {
        $this->_client = new \Guzzle\Http\Client($url);
    }

    /**
     * @param \NordSoftware\Paytrail\Object\Payment $payment
     * @return \NordSoftware\Paytrail\Http\Result
     * @throws \NordSoftware\Paytrail\Exception\PaymentFailed
     */
    public function processPayment(\NordSoftware\Paytrail\Object\Payment $payment)
    {
        $response = $this->postRequest('/api-payment/create', $payment->toJson());

        if ($response->getContentType() !== 'application/json') {
            throw new PaymentFailed('Server returned a non-JSON result.');
        }

        $body = json_decode($response->getMessage());

        if ($response->getStatusCode() !== 201) {
            throw new PaymentFailed(
                sprintf('Paytrail request failed: %s (%d)', $body->errorMessage, $body->errorCode)
            );
        }

        $result = new Result;
        $result->configure(
            array(
                'token' => $body['token'],
                'url'   => $body['url'],
            )
        );
        return $result;
    }

    /**
     * @param string $checksum
     * @param string $orderNumber
     * @param int $timestamp
     * @param string $paid
     * @param int $method
     * @return bool
     */
    protected function validateChecksum($checksum, $orderNumber, $timestamp, $paid, $method)
    {
        return $checksum === $this->calculateChecksum($orderNumber, $timestamp, $paid, $method);
    }

    /**
     * @param string $orderNumber
     * @param int $timestamp
     * @param string $paid
     * @param int $method
     * @return string
     */
    protected function calculateChecksum($orderNumber, $timestamp, $paid, $method)
    {
        return strtoupper(md5("{$orderNumber}|{$timestamp}|{$paid}|{$method}|{$this->_apiSecret}"));
    }

    /**
     * @param $uri
     * @param string|null $body
     * @param array $options
     * @return \Guzzle\Http\Message\Response
     */
    protected function postRequest($uri, $body = null, $options = array())
    {
        if ($this->testMode) {
            $options['debug'] = true;
        }
        return $this->_client->post(
            $uri,
            array(
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-Verkkomaksut-Api-Version' => $this->apiVersion,
            ),
            $body,
            array_merge(
                array(
                    'auth' => array($this->_apiKey, $this->_apiSecret),
                    'timeout' => 30,
                    'connect_timeout' => 10,
                ),
                $options
            )
        )->send();
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;
    }

    /**
     * @param string $apiSecret
     */
    public function setApiSecret($apiSecret)
    {
        $this->_apiSecret = $apiSecret;
    }

    /**
     * @return \Guzzle\Http\Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param int $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        if (!in_array($apiVersion, self::$supportedApiVersions)) {
            throw new UnsupportedApiVersion(sprintf('API version %d is not supported', $apiVersion));
        }
        $this->apiVersion = $apiVersion;
    }
}