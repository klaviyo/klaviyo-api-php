<?php
/**
 * PriceDropTrigger
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Klaviyo API
 *
 * The Klaviyo REST API. Please visit https://developers.klaviyo.com for more details.
 *
 * The version of the OpenAPI document: 2025-04-15
 * Contact: developers@klaviyo.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.1.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace KlaviyoAPI\Model;

use \ArrayAccess;
use \KlaviyoAPI\ObjectSerializer;

/**
 * PriceDropTrigger Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PriceDropTrigger implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PriceDropTrigger';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type' => '\KlaviyoAPI\Model\PriceDropEnum',
        'trigger_filter' => '\KlaviyoAPI\Model\PriceDropConditionFilter',
        'price_drop_amount_value' => '\KlaviyoAPI\Model\NumericOperatorFilterValue',
        'price_drop_amount_unit' => 'string',
        'audience' => 'string[]',
        'timeframe_days' => 'int',
        'currency_type' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'type' => null,
        'trigger_filter' => null,
        'price_drop_amount_value' => null,
        'price_drop_amount_unit' => null,
        'audience' => null,
        'timeframe_days' => null,
        'currency_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'type' => false,
		'trigger_filter' => false,
		'price_drop_amount_value' => false,
		'price_drop_amount_unit' => false,
		'audience' => false,
		'timeframe_days' => false,
		'currency_type' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'type' => 'type',
        'trigger_filter' => 'trigger_filter',
        'price_drop_amount_value' => 'price_drop_amount_value',
        'price_drop_amount_unit' => 'price_drop_amount_unit',
        'audience' => 'audience',
        'timeframe_days' => 'timeframe_days',
        'currency_type' => 'currency_type'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'trigger_filter' => 'setTriggerFilter',
        'price_drop_amount_value' => 'setPriceDropAmountValue',
        'price_drop_amount_unit' => 'setPriceDropAmountUnit',
        'audience' => 'setAudience',
        'timeframe_days' => 'setTimeframeDays',
        'currency_type' => 'setCurrencyType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'trigger_filter' => 'getTriggerFilter',
        'price_drop_amount_value' => 'getPriceDropAmountValue',
        'price_drop_amount_unit' => 'getPriceDropAmountUnit',
        'audience' => 'getAudience',
        'timeframe_days' => 'getTimeframeDays',
        'currency_type' => 'getCurrencyType'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const PRICE_DROP_AMOUNT_UNIT_CURRENCY = 'currency';
    public const PRICE_DROP_AMOUNT_UNIT_PERCENT = 'percent';
    public const AUDIENCE_CHECKOUT_STARTED = 'checkout-started';
    public const AUDIENCE_VIEWED = 'viewed';
    public const CURRENCY_TYPE_USD = 'usd';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPriceDropAmountUnitAllowableValues()
    {
        return [
            self::PRICE_DROP_AMOUNT_UNIT_CURRENCY,
            self::PRICE_DROP_AMOUNT_UNIT_PERCENT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAudienceAllowableValues()
    {
        return [
            self::AUDIENCE_CHECKOUT_STARTED,
            self::AUDIENCE_VIEWED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCurrencyTypeAllowableValues()
    {
        return [
            self::CURRENCY_TYPE_USD,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('trigger_filter', $data ?? [], null);
        $this->setIfExists('price_drop_amount_value', $data ?? [], null);
        $this->setIfExists('price_drop_amount_unit', $data ?? [], 'currency');
        $this->setIfExists('audience', $data ?? [], null);
        $this->setIfExists('timeframe_days', $data ?? [], 30);
        $this->setIfExists('currency_type', $data ?? [], 'usd');
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['trigger_filter'] === null) {
            $invalidProperties[] = "'trigger_filter' can't be null";
        }
        if ($this->container['price_drop_amount_value'] === null) {
            $invalidProperties[] = "'price_drop_amount_value' can't be null";
        }
        $allowedValues = $this->getPriceDropAmountUnitAllowableValues();
        if (!is_null($this->container['price_drop_amount_unit']) && !in_array($this->container['price_drop_amount_unit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'price_drop_amount_unit', must be one of '%s'",
                $this->container['price_drop_amount_unit'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['audience'] === null) {
            $invalidProperties[] = "'audience' can't be null";
        }
        $allowedValues = $this->getCurrencyTypeAllowableValues();
        if (!is_null($this->container['currency_type']) && !in_array($this->container['currency_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'currency_type', must be one of '%s'",
                $this->container['currency_type'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets type
     *
     * @return \KlaviyoAPI\Model\PriceDropEnum
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \KlaviyoAPI\Model\PriceDropEnum $type type
     *
     * @return self
     */
    public function setType($type)
    {

        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }

        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets trigger_filter
     *
     * @return \KlaviyoAPI\Model\PriceDropConditionFilter
     */
    public function getTriggerFilter()
    {
        return $this->container['trigger_filter'];
    }

    /**
     * Sets trigger_filter
     *
     * @param \KlaviyoAPI\Model\PriceDropConditionFilter $trigger_filter trigger_filter
     *
     * @return self
     */
    public function setTriggerFilter($trigger_filter)
    {

        if (is_null($trigger_filter)) {
            throw new \InvalidArgumentException('non-nullable trigger_filter cannot be null');
        }

        $this->container['trigger_filter'] = $trigger_filter;

        return $this;
    }

    /**
     * Gets price_drop_amount_value
     *
     * @return \KlaviyoAPI\Model\NumericOperatorFilterValue
     */
    public function getPriceDropAmountValue()
    {
        return $this->container['price_drop_amount_value'];
    }

    /**
     * Sets price_drop_amount_value
     *
     * @param \KlaviyoAPI\Model\NumericOperatorFilterValue $price_drop_amount_value price_drop_amount_value
     *
     * @return self
     */
    public function setPriceDropAmountValue($price_drop_amount_value)
    {

        if (is_null($price_drop_amount_value)) {
            throw new \InvalidArgumentException('non-nullable price_drop_amount_value cannot be null');
        }

        $this->container['price_drop_amount_value'] = $price_drop_amount_value;

        return $this;
    }

    /**
     * Gets price_drop_amount_unit
     *
     * @return string|null
     */
    public function getPriceDropAmountUnit()
    {
        return $this->container['price_drop_amount_unit'];
    }

    /**
     * Sets price_drop_amount_unit
     *
     * @param string|null $price_drop_amount_unit Price Drop amount type.
     *
     * @return self
     */
    public function setPriceDropAmountUnit($price_drop_amount_unit)
    {
        $allowedValues = $this->getPriceDropAmountUnitAllowableValues();
        if (!is_null($price_drop_amount_unit) && !in_array($price_drop_amount_unit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'price_drop_amount_unit', must be one of '%s'",
                    $price_drop_amount_unit,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($price_drop_amount_unit)) {
            throw new \InvalidArgumentException('non-nullable price_drop_amount_unit cannot be null');
        }

        $this->container['price_drop_amount_unit'] = $price_drop_amount_unit;

        return $this;
    }

    /**
     * Gets audience
     *
     * @return string[]
     */
    public function getAudience()
    {
        return $this->container['audience'];
    }

    /**
     * Sets audience
     *
     * @param string[] $audience audience
     *
     * @return self
     */
    public function setAudience($audience)
    {
        $allowedValues = $this->getAudienceAllowableValues();
        if (array_diff($audience, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'audience', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($audience)) {
            throw new \InvalidArgumentException('non-nullable audience cannot be null');
        }

        $this->container['audience'] = $audience;

        return $this;
    }

    /**
     * Gets timeframe_days
     *
     * @return int|null
     */
    public function getTimeframeDays()
    {
        return $this->container['timeframe_days'];
    }

    /**
     * Sets timeframe_days
     *
     * @param int|null $timeframe_days timeframe_days
     *
     * @return self
     */
    public function setTimeframeDays($timeframe_days)
    {

        if (is_null($timeframe_days)) {
            throw new \InvalidArgumentException('non-nullable timeframe_days cannot be null');
        }

        $this->container['timeframe_days'] = $timeframe_days;

        return $this;
    }

    /**
     * Gets currency_type
     *
     * @return string|null
     */
    public function getCurrencyType()
    {
        return $this->container['currency_type'];
    }

    /**
     * Sets currency_type
     *
     * @param string|null $currency_type Currency type.
     *
     * @return self
     */
    public function setCurrencyType($currency_type)
    {
        $allowedValues = $this->getCurrencyTypeAllowableValues();
        if (!is_null($currency_type) && !in_array($currency_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'currency_type', must be one of '%s'",
                    $currency_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($currency_type)) {
            throw new \InvalidArgumentException('non-nullable currency_type cannot be null');
        }

        $this->container['currency_type'] = $currency_type;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


