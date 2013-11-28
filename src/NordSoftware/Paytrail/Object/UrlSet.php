<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NordSoftware\Paytrail\Object;

use NordSoftware\Paytrail\Common\DataObject;

class UrlSet extends DataObject
{
    /**
     * @var string
     */
    protected $successUrl;

    /**
     * @var string
     */
    protected $failureUrl;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var string
     */
    protected $pendingUrl;

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'success'      => $this->successUrl,
            'failure'      => $this->failureUrl,
            'notification' => $this->notificationUrl,
            'pending'      => $this->pendingUrl,
        );
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @return string
     */
    public function getFailureUrl()
    {
        return $this->failureUrl;
    }

    /**
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * @return string
     */
    public function getPendingUrl()
    {
        return $this->pendingUrl;
    }
}