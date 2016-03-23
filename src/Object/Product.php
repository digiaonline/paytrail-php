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

class Product extends DataObject
{
    const TYPE_NORMAL   = 1;
    const TYPE_POSTAL   = 2;
    const TYPE_HANDLING = 3;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $vat;

    /**
     * @var float
     */
    protected $discount;

    /**
     * @var int
     */
    protected $type = self::TYPE_NORMAL;

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'title'     => $this->title,
            'code'      => $this->code,
            'amount'    => $this->amount,
            'price'     => $this->price,
            'vat'       => $this->vat,
            'discount'  => $this->discount,
            'type'      => $this->type,
        );
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}