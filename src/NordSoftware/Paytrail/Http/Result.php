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

use NordSoftware\Paytrail\Common\Object;

class Result extends Object
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}