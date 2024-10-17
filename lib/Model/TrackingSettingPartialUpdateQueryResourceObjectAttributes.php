<?php
/**
 * TrackingSettingPartialUpdateQueryResourceObjectAttributes
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
 * The version of the OpenAPI document: 2024-10-15
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
 * TrackingSettingPartialUpdateQueryResourceObjectAttributes Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TrackingSettingPartialUpdateQueryResourceObjectAttributes implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TrackingSettingPartialUpdateQueryResourceObject_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'auto_add_parameters' => 'bool',
        'utm_source' => '\KlaviyoAPI\Model\TrackingParamDTO',
        'utm_medium' => '\KlaviyoAPI\Model\TrackingParamDTO',
        'utm_campaign' => '\KlaviyoAPI\Model\TrackingParamDTO',
        'utm_id' => '\KlaviyoAPI\Model\TrackingParamDTO',
        'utm_term' => '\KlaviyoAPI\Model\TrackingParamDTO',
        'custom_parameters' => '\KlaviyoAPI\Model\CustomTrackingParamDTO[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'auto_add_parameters' => null,
        'utm_source' => null,
        'utm_medium' => null,
        'utm_campaign' => null,
        'utm_id' => null,
        'utm_term' => null,
        'custom_parameters' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'auto_add_parameters' => true,
		'utm_source' => false,
		'utm_medium' => false,
		'utm_campaign' => false,
		'utm_id' => false,
		'utm_term' => false,
		'custom_parameters' => true
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
        'auto_add_parameters' => 'auto_add_parameters',
        'utm_source' => 'utm_source',
        'utm_medium' => 'utm_medium',
        'utm_campaign' => 'utm_campaign',
        'utm_id' => 'utm_id',
        'utm_term' => 'utm_term',
        'custom_parameters' => 'custom_parameters'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'auto_add_parameters' => 'setAutoAddParameters',
        'utm_source' => 'setUtmSource',
        'utm_medium' => 'setUtmMedium',
        'utm_campaign' => 'setUtmCampaign',
        'utm_id' => 'setUtmId',
        'utm_term' => 'setUtmTerm',
        'custom_parameters' => 'setCustomParameters'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'auto_add_parameters' => 'getAutoAddParameters',
        'utm_source' => 'getUtmSource',
        'utm_medium' => 'getUtmMedium',
        'utm_campaign' => 'getUtmCampaign',
        'utm_id' => 'getUtmId',
        'utm_term' => 'getUtmTerm',
        'custom_parameters' => 'getCustomParameters'
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
        $this->setIfExists('auto_add_parameters', $data ?? [], null);
        $this->setIfExists('utm_source', $data ?? [], null);
        $this->setIfExists('utm_medium', $data ?? [], null);
        $this->setIfExists('utm_campaign', $data ?? [], null);
        $this->setIfExists('utm_id', $data ?? [], null);
        $this->setIfExists('utm_term', $data ?? [], null);
        $this->setIfExists('custom_parameters', $data ?? [], null);
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
     * Gets auto_add_parameters
     *
     * @return bool|null
     */
    public function getAutoAddParameters()
    {
        return $this->container['auto_add_parameters'];
    }

    /**
     * Sets auto_add_parameters
     *
     * @param bool|null $auto_add_parameters Whether tracking parameters are automatically added to campaigns and flows.
     *
     * @return self
     */
    public function setAutoAddParameters($auto_add_parameters)
    {

        if (is_null($auto_add_parameters)) {
            array_push($this->openAPINullablesSetToNull, 'auto_add_parameters');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('auto_add_parameters', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['auto_add_parameters'] = $auto_add_parameters;

        return $this;
    }

    /**
     * Gets utm_source
     *
     * @return \KlaviyoAPI\Model\TrackingParamDTO|null
     */
    public function getUtmSource()
    {
        return $this->container['utm_source'];
    }

    /**
     * Sets utm_source
     *
     * @param \KlaviyoAPI\Model\TrackingParamDTO|null $utm_source utm_source
     *
     * @return self
     */
    public function setUtmSource($utm_source)
    {

        if (is_null($utm_source)) {
            throw new \InvalidArgumentException('non-nullable utm_source cannot be null');
        }

        $this->container['utm_source'] = $utm_source;

        return $this;
    }

    /**
     * Gets utm_medium
     *
     * @return \KlaviyoAPI\Model\TrackingParamDTO|null
     */
    public function getUtmMedium()
    {
        return $this->container['utm_medium'];
    }

    /**
     * Sets utm_medium
     *
     * @param \KlaviyoAPI\Model\TrackingParamDTO|null $utm_medium utm_medium
     *
     * @return self
     */
    public function setUtmMedium($utm_medium)
    {

        if (is_null($utm_medium)) {
            throw new \InvalidArgumentException('non-nullable utm_medium cannot be null');
        }

        $this->container['utm_medium'] = $utm_medium;

        return $this;
    }

    /**
     * Gets utm_campaign
     *
     * @return \KlaviyoAPI\Model\TrackingParamDTO|null
     */
    public function getUtmCampaign()
    {
        return $this->container['utm_campaign'];
    }

    /**
     * Sets utm_campaign
     *
     * @param \KlaviyoAPI\Model\TrackingParamDTO|null $utm_campaign utm_campaign
     *
     * @return self
     */
    public function setUtmCampaign($utm_campaign)
    {

        if (is_null($utm_campaign)) {
            throw new \InvalidArgumentException('non-nullable utm_campaign cannot be null');
        }

        $this->container['utm_campaign'] = $utm_campaign;

        return $this;
    }

    /**
     * Gets utm_id
     *
     * @return \KlaviyoAPI\Model\TrackingParamDTO|null
     */
    public function getUtmId()
    {
        return $this->container['utm_id'];
    }

    /**
     * Sets utm_id
     *
     * @param \KlaviyoAPI\Model\TrackingParamDTO|null $utm_id utm_id
     *
     * @return self
     */
    public function setUtmId($utm_id)
    {

        if (is_null($utm_id)) {
            throw new \InvalidArgumentException('non-nullable utm_id cannot be null');
        }

        $this->container['utm_id'] = $utm_id;

        return $this;
    }

    /**
     * Gets utm_term
     *
     * @return \KlaviyoAPI\Model\TrackingParamDTO|null
     */
    public function getUtmTerm()
    {
        return $this->container['utm_term'];
    }

    /**
     * Sets utm_term
     *
     * @param \KlaviyoAPI\Model\TrackingParamDTO|null $utm_term utm_term
     *
     * @return self
     */
    public function setUtmTerm($utm_term)
    {

        if (is_null($utm_term)) {
            throw new \InvalidArgumentException('non-nullable utm_term cannot be null');
        }

        $this->container['utm_term'] = $utm_term;

        return $this;
    }

    /**
     * Gets custom_parameters
     *
     * @return \KlaviyoAPI\Model\CustomTrackingParamDTO[]|null
     */
    public function getCustomParameters()
    {
        return $this->container['custom_parameters'];
    }

    /**
     * Sets custom_parameters
     *
     * @param \KlaviyoAPI\Model\CustomTrackingParamDTO[]|null $custom_parameters List of custom tracking parameters.
     *
     * @return self
     */
    public function setCustomParameters($custom_parameters)
    {

        if (is_null($custom_parameters)) {
            array_push($this->openAPINullablesSetToNull, 'custom_parameters');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('custom_parameters', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['custom_parameters'] = $custom_parameters;

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


