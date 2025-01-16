<?php
/**
 * TriggerBranchActionData
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
 * The version of the OpenAPI document: 2025-01-15
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
 * TriggerBranchActionData Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TriggerBranchActionData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TriggerBranchActionData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'trigger_filter' => '\KlaviyoAPI\Model\UnionFilter',
        'trigger_id' => 'string',
        'trigger_type' => 'string',
        'trigger_subtype' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'trigger_filter' => null,
        'trigger_id' => null,
        'trigger_type' => null,
        'trigger_subtype' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'trigger_filter' => false,
		'trigger_id' => false,
		'trigger_type' => false,
		'trigger_subtype' => true
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
        'trigger_filter' => 'trigger_filter',
        'trigger_id' => 'trigger_id',
        'trigger_type' => 'trigger_type',
        'trigger_subtype' => 'trigger_subtype'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'trigger_filter' => 'setTriggerFilter',
        'trigger_id' => 'setTriggerId',
        'trigger_type' => 'setTriggerType',
        'trigger_subtype' => 'setTriggerSubtype'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'trigger_filter' => 'getTriggerFilter',
        'trigger_id' => 'getTriggerId',
        'trigger_type' => 'getTriggerType',
        'trigger_subtype' => 'getTriggerSubtype'
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

    public const TRIGGER_TYPE_DATE = 'date';
    public const TRIGGER_TYPE__LIST = 'list';
    public const TRIGGER_TYPE_LOW_INVENTORY = 'low-inventory';
    public const TRIGGER_TYPE_METRIC = 'metric';
    public const TRIGGER_TYPE_PRICE_DROP = 'price-drop';
    public const TRIGGER_TYPE_SCHEDULED = 'scheduled';
    public const TRIGGER_TYPE_SEGMENT = 'segment';
    public const TRIGGER_SUBTYPE_CUSTOM_OBJECT = 'custom-object';
    public const TRIGGER_SUBTYPE_PROFILE_PROPERTY = 'profile-property';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTriggerTypeAllowableValues()
    {
        return [
            self::TRIGGER_TYPE_DATE,
            self::TRIGGER_TYPE__LIST,
            self::TRIGGER_TYPE_LOW_INVENTORY,
            self::TRIGGER_TYPE_METRIC,
            self::TRIGGER_TYPE_PRICE_DROP,
            self::TRIGGER_TYPE_SCHEDULED,
            self::TRIGGER_TYPE_SEGMENT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTriggerSubtypeAllowableValues()
    {
        return [
            self::TRIGGER_SUBTYPE_CUSTOM_OBJECT,
            self::TRIGGER_SUBTYPE_PROFILE_PROPERTY,
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
        $this->setIfExists('trigger_filter', $data ?? [], null);
        $this->setIfExists('trigger_id', $data ?? [], null);
        $this->setIfExists('trigger_type', $data ?? [], null);
        $this->setIfExists('trigger_subtype', $data ?? [], null);
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

        if ($this->container['trigger_filter'] === null) {
            $invalidProperties[] = "'trigger_filter' can't be null";
        }
        if ($this->container['trigger_id'] === null) {
            $invalidProperties[] = "'trigger_id' can't be null";
        }
        if ($this->container['trigger_type'] === null) {
            $invalidProperties[] = "'trigger_type' can't be null";
        }
        $allowedValues = $this->getTriggerTypeAllowableValues();
        if (!is_null($this->container['trigger_type']) && !in_array($this->container['trigger_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'trigger_type', must be one of '%s'",
                $this->container['trigger_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTriggerSubtypeAllowableValues();
        if (!is_null($this->container['trigger_subtype']) && !in_array($this->container['trigger_subtype'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'trigger_subtype', must be one of '%s'",
                $this->container['trigger_subtype'],
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
     * Gets trigger_filter
     *
     * @return \KlaviyoAPI\Model\UnionFilter
     */
    public function getTriggerFilter()
    {
        return $this->container['trigger_filter'];
    }

    /**
     * Sets trigger_filter
     *
     * @param \KlaviyoAPI\Model\UnionFilter $trigger_filter trigger_filter
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
     * Gets trigger_id
     *
     * @return string
     */
    public function getTriggerId()
    {
        return $this->container['trigger_id'];
    }

    /**
     * Sets trigger_id
     *
     * @param string $trigger_id trigger_id
     *
     * @return self
     */
    public function setTriggerId($trigger_id)
    {

        if (is_null($trigger_id)) {
            throw new \InvalidArgumentException('non-nullable trigger_id cannot be null');
        }

        $this->container['trigger_id'] = $trigger_id;

        return $this;
    }

    /**
     * Gets trigger_type
     *
     * @return string
     */
    public function getTriggerType()
    {
        return $this->container['trigger_type'];
    }

    /**
     * Sets trigger_type
     *
     * @param string $trigger_type Trigger type.
     *
     * @return self
     */
    public function setTriggerType($trigger_type)
    {
        $allowedValues = $this->getTriggerTypeAllowableValues();
        if (!in_array($trigger_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'trigger_type', must be one of '%s'",
                    $trigger_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($trigger_type)) {
            throw new \InvalidArgumentException('non-nullable trigger_type cannot be null');
        }

        $this->container['trigger_type'] = $trigger_type;

        return $this;
    }

    /**
     * Gets trigger_subtype
     *
     * @return string|null
     */
    public function getTriggerSubtype()
    {
        return $this->container['trigger_subtype'];
    }

    /**
     * Sets trigger_subtype
     *
     * @param string|null $trigger_subtype Date trigger type.
     *
     * @return self
     */
    public function setTriggerSubtype($trigger_subtype)
    {
        $allowedValues = $this->getTriggerSubtypeAllowableValues();
        if (!is_null($trigger_subtype) && !in_array($trigger_subtype, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'trigger_subtype', must be one of '%s'",
                    $trigger_subtype,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($trigger_subtype)) {
            array_push($this->openAPINullablesSetToNull, 'trigger_subtype');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('trigger_subtype', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['trigger_subtype'] = $trigger_subtype;

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


