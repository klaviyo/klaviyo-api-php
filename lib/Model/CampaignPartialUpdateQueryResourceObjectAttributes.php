<?php
/**
 * CampaignPartialUpdateQueryResourceObjectAttributes
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
 * The version of the OpenAPI document: 2024-02-15
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
 * CampaignPartialUpdateQueryResourceObjectAttributes Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CampaignPartialUpdateQueryResourceObjectAttributes implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CampaignPartialUpdateQueryResourceObject_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'audiences' => '\KlaviyoAPI\Model\AudiencesSubObject',
        'send_options' => '\KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesSendOptions',
        'tracking_options' => '\KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesTrackingOptions',
        'send_strategy' => '\KlaviyoAPI\Model\SendStrategySubObject'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'audiences' => null,
        'send_options' => null,
        'tracking_options' => null,
        'send_strategy' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => true,
		'audiences' => false,
		'send_options' => true,
		'tracking_options' => true,
		'send_strategy' => false
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
        'name' => 'name',
        'audiences' => 'audiences',
        'send_options' => 'send_options',
        'tracking_options' => 'tracking_options',
        'send_strategy' => 'send_strategy'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'audiences' => 'setAudiences',
        'send_options' => 'setSendOptions',
        'tracking_options' => 'setTrackingOptions',
        'send_strategy' => 'setSendStrategy'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'audiences' => 'getAudiences',
        'send_options' => 'getSendOptions',
        'tracking_options' => 'getTrackingOptions',
        'send_strategy' => 'getSendStrategy'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('audiences', $data ?? [], null);
        $this->setIfExists('send_options', $data ?? [], null);
        $this->setIfExists('tracking_options', $data ?? [], null);
        $this->setIfExists('send_strategy', $data ?? [], null);
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
     * @param string|null $name The campaign name
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
     * Gets audiences
     *
     * @return \KlaviyoAPI\Model\AudiencesSubObject|null
     */
    public function getAudiences()
    {
        return $this->container['audiences'];
    }

    /**
     * Sets audiences
     *
     * @param \KlaviyoAPI\Model\AudiencesSubObject|null $audiences audiences
     *
     * @return self
     */
    public function setAudiences($audiences)
    {

        if (is_null($audiences)) {
            throw new \InvalidArgumentException('non-nullable audiences cannot be null');
        }

        $this->container['audiences'] = $audiences;

        return $this;
    }

    /**
     * Gets send_options
     *
     * @return \KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesSendOptions|null
     */
    public function getSendOptions()
    {
        return $this->container['send_options'];
    }

    /**
     * Sets send_options
     *
     * @param \KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesSendOptions|null $send_options send_options
     *
     * @return self
     */
    public function setSendOptions($send_options)
    {

        if (is_null($send_options)) {
            array_push($this->openAPINullablesSetToNull, 'send_options');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('send_options', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['send_options'] = $send_options;

        return $this;
    }

    /**
     * Gets tracking_options
     *
     * @return \KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesTrackingOptions|null
     */
    public function getTrackingOptions()
    {
        return $this->container['tracking_options'];
    }

    /**
     * Sets tracking_options
     *
     * @param \KlaviyoAPI\Model\CampaignCreateQueryResourceObjectAttributesTrackingOptions|null $tracking_options tracking_options
     *
     * @return self
     */
    public function setTrackingOptions($tracking_options)
    {

        if (is_null($tracking_options)) {
            array_push($this->openAPINullablesSetToNull, 'tracking_options');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('tracking_options', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['tracking_options'] = $tracking_options;

        return $this;
    }

    /**
     * Gets send_strategy
     *
     * @return \KlaviyoAPI\Model\SendStrategySubObject|null
     */
    public function getSendStrategy()
    {
        return $this->container['send_strategy'];
    }

    /**
     * Sets send_strategy
     *
     * @param \KlaviyoAPI\Model\SendStrategySubObject|null $send_strategy send_strategy
     *
     * @return self
     */
    public function setSendStrategy($send_strategy)
    {

        if (is_null($send_strategy)) {
            throw new \InvalidArgumentException('non-nullable send_strategy cannot be null');
        }

        $this->container['send_strategy'] = $send_strategy;

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


