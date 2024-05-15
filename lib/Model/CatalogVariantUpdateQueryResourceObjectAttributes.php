<?php
/**
 * CatalogVariantUpdateQueryResourceObjectAttributes
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
 * The version of the OpenAPI document: 2024-05-15
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
 * CatalogVariantUpdateQueryResourceObjectAttributes Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CatalogVariantUpdateQueryResourceObjectAttributes implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CatalogVariantUpdateQueryResourceObject_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'title' => 'string',
        'description' => 'string',
        'sku' => 'string',
        'inventory_policy' => 'int',
        'inventory_quantity' => 'float',
        'price' => 'float',
        'url' => 'string',
        'image_full_url' => 'string',
        'image_thumbnail_url' => 'string',
        'images' => 'string[]',
        'custom_metadata' => 'object',
        'published' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title' => null,
        'description' => null,
        'sku' => null,
        'inventory_policy' => null,
        'inventory_quantity' => null,
        'price' => null,
        'url' => null,
        'image_full_url' => null,
        'image_thumbnail_url' => null,
        'images' => null,
        'custom_metadata' => null,
        'published' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'title' => true,
		'description' => true,
		'sku' => true,
		'inventory_policy' => true,
		'inventory_quantity' => true,
		'price' => true,
		'url' => true,
		'image_full_url' => true,
		'image_thumbnail_url' => true,
		'images' => true,
		'custom_metadata' => true,
		'published' => true
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
        'title' => 'title',
        'description' => 'description',
        'sku' => 'sku',
        'inventory_policy' => 'inventory_policy',
        'inventory_quantity' => 'inventory_quantity',
        'price' => 'price',
        'url' => 'url',
        'image_full_url' => 'image_full_url',
        'image_thumbnail_url' => 'image_thumbnail_url',
        'images' => 'images',
        'custom_metadata' => 'custom_metadata',
        'published' => 'published'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title' => 'setTitle',
        'description' => 'setDescription',
        'sku' => 'setSku',
        'inventory_policy' => 'setInventoryPolicy',
        'inventory_quantity' => 'setInventoryQuantity',
        'price' => 'setPrice',
        'url' => 'setUrl',
        'image_full_url' => 'setImageFullUrl',
        'image_thumbnail_url' => 'setImageThumbnailUrl',
        'images' => 'setImages',
        'custom_metadata' => 'setCustomMetadata',
        'published' => 'setPublished'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title' => 'getTitle',
        'description' => 'getDescription',
        'sku' => 'getSku',
        'inventory_policy' => 'getInventoryPolicy',
        'inventory_quantity' => 'getInventoryQuantity',
        'price' => 'getPrice',
        'url' => 'getUrl',
        'image_full_url' => 'getImageFullUrl',
        'image_thumbnail_url' => 'getImageThumbnailUrl',
        'images' => 'getImages',
        'custom_metadata' => 'getCustomMetadata',
        'published' => 'getPublished'
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

    public const INVENTORY_POLICY_0 = 0;
    public const INVENTORY_POLICY_1 = 1;
    public const INVENTORY_POLICY_2 = 2;

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInventoryPolicyAllowableValues()
    {
        return [
            self::INVENTORY_POLICY_0,
            self::INVENTORY_POLICY_1,
            self::INVENTORY_POLICY_2,
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
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('sku', $data ?? [], null);
        $this->setIfExists('inventory_policy', $data ?? [], null);
        $this->setIfExists('inventory_quantity', $data ?? [], null);
        $this->setIfExists('price', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('image_full_url', $data ?? [], null);
        $this->setIfExists('image_thumbnail_url', $data ?? [], null);
        $this->setIfExists('images', $data ?? [], null);
        $this->setIfExists('custom_metadata', $data ?? [], null);
        $this->setIfExists('published', $data ?? [], null);
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

        $allowedValues = $this->getInventoryPolicyAllowableValues();
        if (!is_null($this->container['inventory_policy']) && !in_array($this->container['inventory_policy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'inventory_policy', must be one of '%s'",
                $this->container['inventory_policy'],
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
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The title of the catalog item variant.
     *
     * @return self
     */
    public function setTitle($title)
    {

        if (is_null($title)) {
            array_push($this->openAPINullablesSetToNull, 'title');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('title', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description A description of the catalog item variant.
     *
     * @return self
     */
    public function setDescription($description)
    {

        if (is_null($description)) {
            array_push($this->openAPINullablesSetToNull, 'description');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('description', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets sku
     *
     * @return string|null
     */
    public function getSku()
    {
        return $this->container['sku'];
    }

    /**
     * Sets sku
     *
     * @param string|null $sku The SKU of the catalog item variant.
     *
     * @return self
     */
    public function setSku($sku)
    {

        if (is_null($sku)) {
            array_push($this->openAPINullablesSetToNull, 'sku');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('sku', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['sku'] = $sku;

        return $this;
    }

    /**
     * Gets inventory_policy
     *
     * @return int|null
     */
    public function getInventoryPolicy()
    {
        return $this->container['inventory_policy'];
    }

    /**
     * Sets inventory_policy
     *
     * @param int|null $inventory_policy This field controls the visibility of this catalog item variant in product feeds/blocks. This field supports the following values: `1`: a product will not appear in dynamic product recommendation feeds and blocks if it is out of stock. `0` or `2`: a product can appear in dynamic product recommendation feeds and blocks regardless of inventory quantity.
     *
     * @return self
     */
    public function setInventoryPolicy($inventory_policy)
    {
        $allowedValues = $this->getInventoryPolicyAllowableValues();
        if (!is_null($inventory_policy) && !in_array($inventory_policy, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'inventory_policy', must be one of '%s'",
                    $inventory_policy,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($inventory_policy)) {
            array_push($this->openAPINullablesSetToNull, 'inventory_policy');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('inventory_policy', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['inventory_policy'] = $inventory_policy;

        return $this;
    }

    /**
     * Gets inventory_quantity
     *
     * @return float|null
     */
    public function getInventoryQuantity()
    {
        return $this->container['inventory_quantity'];
    }

    /**
     * Sets inventory_quantity
     *
     * @param float|null $inventory_quantity The quantity of the catalog item variant currently in stock.
     *
     * @return self
     */
    public function setInventoryQuantity($inventory_quantity)
    {

        if (is_null($inventory_quantity)) {
            array_push($this->openAPINullablesSetToNull, 'inventory_quantity');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('inventory_quantity', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['inventory_quantity'] = $inventory_quantity;

        return $this;
    }

    /**
     * Gets price
     *
     * @return float|null
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param float|null $price This field can be used to set the price on the catalog item variant, which is what gets displayed for the item variant when included in emails. For most price-update use cases, you will also want to update the `price` on any parent items using the [Update Catalog Item Endpoint](https://developers.klaviyo.com/en/reference/update_catalog_item).
     *
     * @return self
     */
    public function setPrice($price)
    {

        if (is_null($price)) {
            array_push($this->openAPINullablesSetToNull, 'price');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string|null $url URL pointing to the location of the catalog item variant on your website.
     *
     * @return self
     */
    public function setUrl($url)
    {

        if (is_null($url)) {
            array_push($this->openAPINullablesSetToNull, 'url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets image_full_url
     *
     * @return string|null
     */
    public function getImageFullUrl()
    {
        return $this->container['image_full_url'];
    }

    /**
     * Sets image_full_url
     *
     * @param string|null $image_full_url URL pointing to the location of a full image of the catalog item variant.
     *
     * @return self
     */
    public function setImageFullUrl($image_full_url)
    {

        if (is_null($image_full_url)) {
            array_push($this->openAPINullablesSetToNull, 'image_full_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('image_full_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['image_full_url'] = $image_full_url;

        return $this;
    }

    /**
     * Gets image_thumbnail_url
     *
     * @return string|null
     */
    public function getImageThumbnailUrl()
    {
        return $this->container['image_thumbnail_url'];
    }

    /**
     * Sets image_thumbnail_url
     *
     * @param string|null $image_thumbnail_url URL pointing to the location of an image thumbnail of the catalog item variant.
     *
     * @return self
     */
    public function setImageThumbnailUrl($image_thumbnail_url)
    {

        if (is_null($image_thumbnail_url)) {
            array_push($this->openAPINullablesSetToNull, 'image_thumbnail_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('image_thumbnail_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['image_thumbnail_url'] = $image_thumbnail_url;

        return $this;
    }

    /**
     * Gets images
     *
     * @return string[]|null
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param string[]|null $images List of URLs pointing to the locations of images of the catalog item variant.
     *
     * @return self
     */
    public function setImages($images)
    {

        if (is_null($images)) {
            array_push($this->openAPINullablesSetToNull, 'images');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('images', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets custom_metadata
     *
     * @return object|null
     */
    public function getCustomMetadata()
    {
        return $this->container['custom_metadata'];
    }

    /**
     * Sets custom_metadata
     *
     * @param object|null $custom_metadata Flat JSON blob to provide custom metadata about the catalog item variant. May not exceed 100kb.
     *
     * @return self
     */
    public function setCustomMetadata($custom_metadata)
    {

        if (is_null($custom_metadata)) {
            array_push($this->openAPINullablesSetToNull, 'custom_metadata');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('custom_metadata', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['custom_metadata'] = $custom_metadata;

        return $this;
    }

    /**
     * Gets published
     *
     * @return bool|null
     */
    public function getPublished()
    {
        return $this->container['published'];
    }

    /**
     * Sets published
     *
     * @param bool|null $published Boolean value indicating whether the catalog item variant is published.
     *
     * @return self
     */
    public function setPublished($published)
    {

        if (is_null($published)) {
            array_push($this->openAPINullablesSetToNull, 'published');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('published', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['published'] = $published;

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


