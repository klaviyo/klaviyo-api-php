<?php
/**
 * EmailTrackingOptionsSubObject
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
 * The version of the OpenAPI document: 2024-06-15
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
 * EmailTrackingOptionsSubObject Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EmailTrackingOptionsSubObject implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EmailTrackingOptionsSubObject';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'is_add_utm' => 'bool',
        'utm_params' => '\KlaviyoAPI\Model\UTMParamsSubObject[]',
        'is_tracking_clicks' => 'bool',
        'is_tracking_opens' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'is_add_utm' => null,
        'utm_params' => null,
        'is_tracking_clicks' => null,
        'is_tracking_opens' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'is_add_utm' => true,
		'utm_params' => true,
		'is_tracking_clicks' => true,
		'is_tracking_opens' => true
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
        'is_add_utm' => 'is_add_utm',
        'utm_params' => 'utm_params',
        'is_tracking_clicks' => 'is_tracking_clicks',
        'is_tracking_opens' => 'is_tracking_opens'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'is_add_utm' => 'setIsAddUtm',
        'utm_params' => 'setUtmParams',
        'is_tracking_clicks' => 'setIsTrackingClicks',
        'is_tracking_opens' => 'setIsTrackingOpens'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'is_add_utm' => 'getIsAddUtm',
        'utm_params' => 'getUtmParams',
        'is_tracking_clicks' => 'getIsTrackingClicks',
        'is_tracking_opens' => 'getIsTrackingOpens'
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
        $this->setIfExists('is_add_utm', $data ?? [], null);
        $this->setIfExists('utm_params', $data ?? [], null);
        $this->setIfExists('is_tracking_clicks', $data ?? [], null);
        $this->setIfExists('is_tracking_opens', $data ?? [], null);
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
     * Gets is_add_utm
     *
     * @return bool|null
     */
    public function getIsAddUtm()
    {
        return $this->container['is_add_utm'];
    }

    /**
     * Sets is_add_utm
     *
     * @param bool|null $is_add_utm Whether the campaign needs UTM parameters. If set to False, UTM params will not be used.
     *
     * @return self
     */
    public function setIsAddUtm($is_add_utm)
    {

        if (is_null($is_add_utm)) {
            array_push($this->openAPINullablesSetToNull, 'is_add_utm');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('is_add_utm', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['is_add_utm'] = $is_add_utm;

        return $this;
    }

    /**
     * Gets utm_params
     *
     * @return \KlaviyoAPI\Model\UTMParamsSubObject[]|null
     */
    public function getUtmParams()
    {
        return $this->container['utm_params'];
    }

    /**
     * Sets utm_params
     *
     * @param \KlaviyoAPI\Model\UTMParamsSubObject[]|null $utm_params A list of UTM parameters. If an empty list is given and is_add_utm is True, uses company defaults.
     *
     * @return self
     */
    public function setUtmParams($utm_params)
    {

        if (is_null($utm_params)) {
            array_push($this->openAPINullablesSetToNull, 'utm_params');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('utm_params', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['utm_params'] = $utm_params;

        return $this;
    }

    /**
     * Gets is_tracking_clicks
     *
     * @return bool|null
     */
    public function getIsTrackingClicks()
    {
        return $this->container['is_tracking_clicks'];
    }

    /**
     * Sets is_tracking_clicks
     *
     * @param bool|null $is_tracking_clicks Whether the campaign is tracking click events. If not specified, uses company defaults.
     *
     * @return self
     */
    public function setIsTrackingClicks($is_tracking_clicks)
    {

        if (is_null($is_tracking_clicks)) {
            array_push($this->openAPINullablesSetToNull, 'is_tracking_clicks');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('is_tracking_clicks', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['is_tracking_clicks'] = $is_tracking_clicks;

        return $this;
    }

    /**
     * Gets is_tracking_opens
     *
     * @return bool|null
     */
    public function getIsTrackingOpens()
    {
        return $this->container['is_tracking_opens'];
    }

    /**
     * Sets is_tracking_opens
     *
     * @param bool|null $is_tracking_opens Whether the campaign is tracking open events. If not specified, uses company defaults.
     *
     * @return self
     */
    public function setIsTrackingOpens($is_tracking_opens)
    {

        if (is_null($is_tracking_opens)) {
            array_push($this->openAPINullablesSetToNull, 'is_tracking_opens');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('is_tracking_opens', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['is_tracking_opens'] = $is_tracking_opens;

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


