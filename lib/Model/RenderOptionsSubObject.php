<?php
/**
 * RenderOptionsSubObject
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
 * The version of the OpenAPI document: 2023-10-15
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
 * RenderOptionsSubObject Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class RenderOptionsSubObject implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'RenderOptionsSubObject';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'shorten_links' => 'bool',
        'add_org_prefix' => 'bool',
        'add_info_link' => 'bool',
        'add_opt_out_language' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'shorten_links' => null,
        'add_org_prefix' => null,
        'add_info_link' => null,
        'add_opt_out_language' => null
    ];

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
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'shorten_links' => 'shorten_links',
        'add_org_prefix' => 'add_org_prefix',
        'add_info_link' => 'add_info_link',
        'add_opt_out_language' => 'add_opt_out_language'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'shorten_links' => 'setShortenLinks',
        'add_org_prefix' => 'setAddOrgPrefix',
        'add_info_link' => 'setAddInfoLink',
        'add_opt_out_language' => 'setAddOptOutLanguage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'shorten_links' => 'getShortenLinks',
        'add_org_prefix' => 'getAddOrgPrefix',
        'add_info_link' => 'getAddInfoLink',
        'add_opt_out_language' => 'getAddOptOutLanguage'
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
        $this->container['shorten_links'] = $data['shorten_links'] ?? true;
        $this->container['add_org_prefix'] = $data['add_org_prefix'] ?? true;
        $this->container['add_info_link'] = $data['add_info_link'] ?? true;
        $this->container['add_opt_out_language'] = $data['add_opt_out_language'] ?? false;
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
     * Gets shorten_links
     *
     * @return bool|null
     */
    public function getShortenLinks()
    {
        return $this->container['shorten_links'];
    }

    /**
     * Sets shorten_links
     *
     * @param bool|null $shorten_links shorten_links
     *
     * @return self
     */
    public function setShortenLinks($shorten_links)
    {
        $this->container['shorten_links'] = $shorten_links;

        return $this;
    }

    /**
     * Gets add_org_prefix
     *
     * @return bool|null
     */
    public function getAddOrgPrefix()
    {
        return $this->container['add_org_prefix'];
    }

    /**
     * Sets add_org_prefix
     *
     * @param bool|null $add_org_prefix add_org_prefix
     *
     * @return self
     */
    public function setAddOrgPrefix($add_org_prefix)
    {
        $this->container['add_org_prefix'] = $add_org_prefix;

        return $this;
    }

    /**
     * Gets add_info_link
     *
     * @return bool|null
     */
    public function getAddInfoLink()
    {
        return $this->container['add_info_link'];
    }

    /**
     * Sets add_info_link
     *
     * @param bool|null $add_info_link add_info_link
     *
     * @return self
     */
    public function setAddInfoLink($add_info_link)
    {
        $this->container['add_info_link'] = $add_info_link;

        return $this;
    }

    /**
     * Gets add_opt_out_language
     *
     * @return bool|null
     */
    public function getAddOptOutLanguage()
    {
        return $this->container['add_opt_out_language'];
    }

    /**
     * Sets add_opt_out_language
     *
     * @param bool|null $add_opt_out_language add_opt_out_language
     *
     * @return self
     */
    public function setAddOptOutLanguage($add_opt_out_language)
    {
        $this->container['add_opt_out_language'] = $add_opt_out_language;

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


