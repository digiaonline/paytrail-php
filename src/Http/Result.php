<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Paytrail\Http;

use Paytrail\Common\Object;

/**
 * Class Result.
 *
 * @package Paytrail\Http
 */
class Result extends Object
{

    /**
     * Order number.
     *
     * @var string $orderNumber
     */
    protected $orderNumber;

    /**
     * Token.
     *
     * @var string $token
     */
    protected $token;

    /**
     * URL.
     *
     * @var string $url
     */
    protected $url;

    /**
     * Get order number.
     *
     * @return string The order number.
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Get token.
     *
     * @return string The token.
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get URL.
     *
     * @return string The URL.
     */
    public function getUrl()
    {
        return $this->url;
    }
}
