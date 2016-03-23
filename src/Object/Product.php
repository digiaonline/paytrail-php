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
 * Class Product.
 *
 * @package Paytrail\Object
 */
class Product extends DataObject
{

    /**
     * Product type normal.
     *
     * @var int TYPE_NORMAL
     */
    const TYPE_NORMAL = 1;

    /**
     * Product type postal.
     *
     * @var int TYPE_POSTAL
     */
    const TYPE_POSTAL = 2;

    /**
     * Product type handling.
     *
     * @var int TYPE_HANDLING
     */
    const TYPE_HANDLING = 3;

    /**
     * Product title.
     *
     * @var string $title
     */
    protected $title;

    /**
     * Product code.
     *
     * @var string $code
     */
    protected $code;

    /**
     * Product amount.
     *
     * @var float $amount
     */
    protected $amount;

    /**
     * Product price.
     *
     * @var float $price
     */
    protected $price;

    /**
     * Product VAT.
     *
     * @var float $vat
     */
    protected $vat;

    /**
     * Product discount.
     *
     * @var float $discount
     */
    protected $discount;

    /**
     * Product type, defaults to TYPE_NORMAL.
     *
     * @var int $type
     */
    protected $type = self::TYPE_NORMAL;

    /**
     * Convert Product object to array.
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'title'    => $this->title,
            'code'     => $this->code,
            'amount'   => $this->amount,
            'price'    => $this->price,
            'vat'      => $this->vat,
            'discount' => $this->discount,
            'type'     => $this->type,
        );
    }

    /**
     * Get product title.
     *
     * @return string The title.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get product code.
     *
     * @return string The code.
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get product amount.
     *
     * @return float The amount.
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get product price.
     *
     * @return float The price.
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get product VAT.
     *
     * @return float The VAT.
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Get product discount.
     *
     * @return float The discount.
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Get product type.
     *
     * @return int The type.
     */
    public function getType()
    {
        return $this->type;
    }
}
