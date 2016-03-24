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
use Paytrail\Exception\TooManyProducts;
use Paytrail\Exception\CurrencyNotSupported;
use Paytrail\Exception\LocaleNotSupported;

/**
 * Class Payment.
 *
 * @package Paytrail\Object
 */
class Payment extends DataObject
{

    /**
     * Currency Euro.
     *
     * @var string CURRENCY_EUR
     */
    const CURRENCY_EUR = 'EUR';

    /**
     * Finnish locale.
     *
     * @var string LOCALE_FIFI
     */
    const LOCALE_FIFI = 'fi_FI';

    /**
     * Swedish locale.
     *
     * @var string LOCALE_SVSE
     */
    const LOCALE_SVSE = 'sv_SE';

    /**
     * English US locale.
     *
     * @var string LOCALE_ENUS
     */
    const LOCALE_ENUS = 'en_US';

    /**
     * VAT included.
     *
     * @var int VAT_MODE_INCLUDED
     */
    const VAT_MODE_INCLUDED = 1;

    /**
     * VAT excluded.
     *
     * @var int VAT_MODE_EXCLUDED
     */
    const VAT_MODE_EXCLUDED = 0;

    /**
     * Max products.
     *
     * @var int MAX_PRODUCT_COUNT
     */
    const MAX_PRODUCT_COUNT = 500;

    /**
     * The order number.
     *
     * @var string $orderNumber
     */
    protected $orderNumber;

    /**
     * The reference number.
     *
     * @var string $referenceNumber
     */
    protected $referenceNumber = '';

    /**
     * Description.
     *
     * @var string $description
     */
    protected $description = '';

    /**
     * Currency, defaults to Euro.
     *
     * @var string $currency
     */
    protected $currency = self::CURRENCY_EUR;

    /**
     * The locale, defaults to Finnish.
     *
     * @var string $locale
     */
    protected $locale = self::LOCALE_FIFI;

    /**
     * VAT mode, defaults to VAT included.
     *
     * @var int $vatMode
     */
    protected $vatMode = self::VAT_MODE_INCLUDED;

    /**
     * The contact object.
     *
     * @var \Paytrail\Object\Contact $contact
     */
    protected $contact;

    /**
     * The URL set object.
     *
     * @var \Paytrail\Object\UrlSet $urlSet
     */
    protected $urlSet;

    /**
     * List of product objects.
     *
     * @var \Paytrail\Object\Product[] $products
     */
    protected $products = array();

    /**
     * List of supported currencies.
     *
     * @var array $supportedCurrencies
     */
    static $supportedCurrencies = array(
        self::CURRENCY_EUR,
    );

    /**
     * List of supported locales.
     *
     * @var array $supportedLocales
     */
    static $supportedLocales = array(
        self::LOCALE_FIFI,
        self::LOCALE_SVSE,
        self::LOCALE_ENUS,
    );

    /**
     * Add a product.
     *
     * @param \Paytrail\Object\Product $product The product to add.
     *
     * @throws \Paytrail\Exception\TooManyProducts
     */
    public function addProduct(Product $product)
    {
        if (count($this->products) > self::MAX_PRODUCT_COUNT) {
            throw new TooManyProducts(
                sprintf(
                    'Paytrail can only handle up to %d different products. Please group products using "amount".',
                    self::MAX_PRODUCT_COUNT
                )
            );
        }
        $this->products[] = $product;
    }

    /**
     * Convert the payment object to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();

        $array['orderNumber'] = $this->orderNumber;
        if (isset($this->referenceNumber)) {
            $array['referenceNumber'] = $this->referenceNumber;
        }
        if (isset($this->description)) {
            $array['description'] = $this->description;
        }
        $array['currency'] = $this->currency;
        if (isset($this->locale)) {
            $array['locale'] = $this->locale;
        }
        $array['orderDetails'] = array(
            'includeVat' => $this->vatMode,
            'products'   => array(),
        );
        if ($this->urlSet !== null) {
            $array['urlSet'] = $this->urlSet->toArray();
        }
        if ($this->contact !== null) {
            $array['orderDetails']['contact'] = $this->contact->toArray();
        }
        foreach ($this->products as $product) {
            $array['orderDetails']['products'][] = $product->toArray();
        }

        return $array;
    }

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
     * Get reference number.
     *
     * @return string The reference number.
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Get description.
     *
     * @return string The description.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the currency.
     *
     * @param string $currency Currency to set.
     *
     * @throws \Paytrail\Exception\CurrencyNotSupported
     */
    public function setCurrency($currency)
    {
        if ( ! in_array($currency, self::$supportedCurrencies)) {
            throw new CurrencyNotSupported(sprintf('Currency "%s" is not supported.', $currency));
        }
        $this->currency = $currency;
    }

    /**
     * Get currency.
     *
     * @return string The currency.
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Sets the locale.
     *
     * @param string $locale The locale to set.
     *
     * @throws @throws \Paytrail\Exception\LocaleNotSupported
     */
    public function setLocale($locale)
    {
        if ( ! in_array($locale, self::$supportedLocales)) {
            throw new LocaleNotSupported(sprintf('Locale "%s" is not supported.', $locale));
        }
        $this->locale = $locale;
    }

    /**
     * Get locale.
     *
     * @return string The locale.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Get VAT mode.
     *
     * @return int The VAT mode.
     */
    public function getVatMode()
    {
        return $this->vatMode;
    }

    /**
     * Get contact.
     *
     * @return \Paytrail\Object\Contact The contact object.
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Get URL set.
     *
     * @return \Paytrail\Object\UrlSet The URLSet object.
     */
    public function getUrlSet()
    {
        return $this->urlSet;
    }
}
