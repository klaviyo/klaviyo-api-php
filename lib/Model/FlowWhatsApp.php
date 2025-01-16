<?php
/**
 * FlowWhatsApp
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
 * FlowWhatsApp Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class FlowWhatsApp implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'FlowWhatsApp';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'vendor_id' => 'string',
        'smart_sending_enabled' => 'bool',
        'transactional' => 'bool',
        'add_tracking_params' => 'bool',
        'custom_tracking_params' => '\KlaviyoAPI\Model\UtmParam[]',
        'additional_filters' => '\KlaviyoAPI\Model\UnionFilter'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'vendor_id' => null,
        'smart_sending_enabled' => null,
        'transactional' => null,
        'add_tracking_params' => null,
        'custom_tracking_params' => null,
        'additional_filters' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => true,
		'name' => true,
		'vendor_id' => true,
		'smart_sending_enabled' => false,
		'transactional' => false,
		'add_tracking_params' => false,
		'custom_tracking_params' => true,
		'additional_filters' => false
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
        'id' => 'id',
        'name' => 'name',
        'vendor_id' => 'vendor_id',
        'smart_sending_enabled' => 'smart_sending_enabled',
        'transactional' => 'transactional',
        'add_tracking_params' => 'add_tracking_params',
        'custom_tracking_params' => 'custom_tracking_params',
        'additional_filters' => 'additional_filters'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'vendor_id' => 'setVendorId',
        'smart_sending_enabled' => 'setSmartSendingEnabled',
        'transactional' => 'setTransactional',
        'add_tracking_params' => 'setAddTrackingParams',
        'custom_tracking_params' => 'setCustomTrackingParams',
        'additional_filters' => 'setAdditionalFilters'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'vendor_id' => 'getVendorId',
        'smart_sending_enabled' => 'getSmartSendingEnabled',
        'transactional' => 'getTransactional',
        'add_tracking_params' => 'getAddTrackingParams',
        'custom_tracking_params' => 'getCustomTrackingParams',
        'additional_filters' => 'getAdditionalFilters'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('vendor_id', $data ?? [], null);
        $this->setIfExists('smart_sending_enabled', $data ?? [], true);
        $this->setIfExists('transactional', $data ?? [], false);
        $this->setIfExists('add_tracking_params', $data ?? [], false);
        $this->setIfExists('custom_tracking_params', $data ?? [], null);
        $this->setIfExists('additional_filters', $data ?? [], null);
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id id
     *
     * @return self
     */
    public function setId($id)
    {

        if (is_null($id)) {
            array_push($this->openAPINullablesSetToNull, 'id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {

        if (is_null($name)) {
            array_push($this->openAPINullablesSetToNull, 'name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets vendor_id
     *
     * @return string|null
     */
    public function getVendorId()
    {
        return $this->container['vendor_id'];
    }

    /**
     * Sets vendor_id
     *
     * @param string|null $vendor_id vendor_id
     *
     * @return self
     */
    public function setVendorId($vendor_id)
    {

        if (is_null($vendor_id)) {
            array_push($this->openAPINullablesSetToNull, 'vendor_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('vendor_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['vendor_id'] = $vendor_id;

        return $this;
    }

    /**
     * Gets smart_sending_enabled
     *
     * @return bool|null
     */
    public function getSmartSendingEnabled()
    {
        return $this->container['smart_sending_enabled'];
    }

    /**
     * Sets smart_sending_enabled
     *
     * @param bool|null $smart_sending_enabled smart_sending_enabled
     *
     * @return self
     */
    public function setSmartSendingEnabled($smart_sending_enabled)
    {

        if (is_null($smart_sending_enabled)) {
            throw new \InvalidArgumentException('non-nullable smart_sending_enabled cannot be null');
        }

        $this->container['smart_sending_enabled'] = $smart_sending_enabled;

        return $this;
    }

    /**
     * Gets transactional
     *
     * @return bool|null
     */
    public function getTransactional()
    {
        return $this->container['transactional'];
    }

    /**
     * Sets transactional
     *
     * @param bool|null $transactional transactional
     *
     * @return self
     */
    public function setTransactional($transactional)
    {

        if (is_null($transactional)) {
            throw new \InvalidArgumentException('non-nullable transactional cannot be null');
        }

        $this->container['transactional'] = $transactional;

        return $this;
    }

    /**
     * Gets add_tracking_params
     *
     * @return bool|null
     */
    public function getAddTrackingParams()
    {
        return $this->container['add_tracking_params'];
    }

    /**
     * Sets add_tracking_params
     *
     * @param bool|null $add_tracking_params add_tracking_params
     *
     * @return self
     */
    public function setAddTrackingParams($add_tracking_params)
    {

        if (is_null($add_tracking_params)) {
            throw new \InvalidArgumentException('non-nullable add_tracking_params cannot be null');
        }

        $this->container['add_tracking_params'] = $add_tracking_params;

        return $this;
    }

    /**
     * Gets custom_tracking_params
     *
     * @return \KlaviyoAPI\Model\UtmParam[]|null
     */
    public function getCustomTrackingParams()
    {
        return $this->container['custom_tracking_params'];
    }

    /**
     * Sets custom_tracking_params
     *
     * @param \KlaviyoAPI\Model\UtmParam[]|null $custom_tracking_params custom_tracking_params
     *
     * @return self
     */
    public function setCustomTrackingParams($custom_tracking_params)
    {

        if (is_null($custom_tracking_params)) {
            array_push($this->openAPINullablesSetToNull, 'custom_tracking_params');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('custom_tracking_params', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['custom_tracking_params'] = $custom_tracking_params;

        return $this;
    }

    /**
     * Gets additional_filters
     *
     * @return \KlaviyoAPI\Model\UnionFilter|null
     */
    public function getAdditionalFilters()
    {
        return $this->container['additional_filters'];
    }

    /**
     * Sets additional_filters
     *
     * @param \KlaviyoAPI\Model\UnionFilter|null $additional_filters additional_filters
     *
     * @return self
     */
    public function setAdditionalFilters($additional_filters)
    {

        if (is_null($additional_filters)) {
            throw new \InvalidArgumentException('non-nullable additional_filters cannot be null');
        }

        $this->container['additional_filters'] = $additional_filters;

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

