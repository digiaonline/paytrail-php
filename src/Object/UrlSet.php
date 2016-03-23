<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Paytrail\Object;

use Paytrail\Common\DataObject;

/**
 * Class UrlSet.
 *
 * @package Paytrail\Object
 */
class UrlSet extends DataObject
{

    /**
     * URL for successful payments.
     *
     * @var string $successUrl
     */
    protected $successUrl;

    /**
     * URL for failed payments.
     *
     * @var string $failureUrl
     */
    protected $failureUrl;

    /**
     * URL for payment notifications.
     *
     * @var string $notificationUrl
     */
    protected $notificationUrl;

    /**
     * URL for pending payments.
     *
     * @var string $pendingUrl
     */
    protected $pendingUrl;

    /**
     * Convert the URLSet object to an array.
     *
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
     * Get success URL.
     *
     * @return string The URL.
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * Get failure URL.
     *
     * @return string The URL.
     */
    public function getFailureUrl()
    {
        return $this->failureUrl;
    }

    /**
     * Get notification URL.
     *
     * @return string The URL.
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * Get pending URL.
     *
     * @return string The URL.
     */
    public function getPendingUrl()
    {
        return $this->pendingUrl;
    }
}
