<?php
/**
 * CampaignMessageCreateQueryResourceObjectAttributesContent
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
 * CampaignMessageCreateQueryResourceObjectAttributesContent Class Doc Comment
 *
 * @category Class
 * @description Additional attributes relating to the content of the message
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CampaignMessageCreateQueryResourceObjectAttributesContent implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CampaignMessageCreateQueryResourceObject_attributes_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'subject' => 'string',
        'preview_text' => 'string',
        'from_email' => 'string',
        'from_label' => 'string',
        'reply_to_email' => 'string',
        'cc_email' => 'string',
        'bcc_email' => 'string',
        'body' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'subject' => null,
        'preview_text' => null,
        'from_email' => null,
        'from_label' => null,
        'reply_to_email' => null,
        'cc_email' => null,
        'bcc_email' => null,
        'body' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'subject' => true,
		'preview_text' => true,
		'from_email' => true,
		'from_label' => true,
		'reply_to_email' => true,
		'cc_email' => true,
		'bcc_email' => true,
		'body' => true
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
        'subject' => 'subject',
        'preview_text' => 'preview_text',
        'from_email' => 'from_email',
        'from_label' => 'from_label',
        'reply_to_email' => 'reply_to_email',
        'cc_email' => 'cc_email',
        'bcc_email' => 'bcc_email',
        'body' => 'body'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'subject' => 'setSubject',
        'preview_text' => 'setPreviewText',
        'from_email' => 'setFromEmail',
        'from_label' => 'setFromLabel',
        'reply_to_email' => 'setReplyToEmail',
        'cc_email' => 'setCcEmail',
        'bcc_email' => 'setBccEmail',
        'body' => 'setBody'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'subject' => 'getSubject',
        'preview_text' => 'getPreviewText',
        'from_email' => 'getFromEmail',
        'from_label' => 'getFromLabel',
        'reply_to_email' => 'getReplyToEmail',
        'cc_email' => 'getCcEmail',
        'bcc_email' => 'getBccEmail',
        'body' => 'getBody'
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
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('preview_text', $data ?? [], null);
        $this->setIfExists('from_email', $data ?? [], null);
        $this->setIfExists('from_label', $data ?? [], null);
        $this->setIfExists('reply_to_email', $data ?? [], null);
        $this->setIfExists('cc_email', $data ?? [], null);
        $this->setIfExists('bcc_email', $data ?? [], null);
        $this->setIfExists('body', $data ?? [], null);
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
     * Gets subject
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string|null $subject The subject of the message
     *
     * @return self
     */
    public function setSubject($subject)
    {

        if (is_null($subject)) {
            array_push($this->openAPINullablesSetToNull, 'subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets preview_text
     *
     * @return string|null
     */
    public function getPreviewText()
    {
        return $this->container['preview_text'];
    }

    /**
     * Sets preview_text
     *
     * @param string|null $preview_text Preview text associated with the message
     *
     * @return self
     */
    public function setPreviewText($preview_text)
    {

        if (is_null($preview_text)) {
            array_push($this->openAPINullablesSetToNull, 'preview_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('preview_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['preview_text'] = $preview_text;

        return $this;
    }

    /**
     * Gets from_email
     *
     * @return string|null
     */
    public function getFromEmail()
    {
        return $this->container['from_email'];
    }

    /**
     * Sets from_email
     *
     * @param string|null $from_email The email the message should be sent from
     *
     * @return self
     */
    public function setFromEmail($from_email)
    {

        if (is_null($from_email)) {
            array_push($this->openAPINullablesSetToNull, 'from_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('from_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['from_email'] = $from_email;

        return $this;
    }

    /**
     * Gets from_label
     *
     * @return string|null
     */
    public function getFromLabel()
    {
        return $this->container['from_label'];
    }

    /**
     * Sets from_label
     *
     * @param string|null $from_label The label associated with the from_email
     *
     * @return self
     */
    public function setFromLabel($from_label)
    {

        if (is_null($from_label)) {
            array_push($this->openAPINullablesSetToNull, 'from_label');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('from_label', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['from_label'] = $from_label;

        return $this;
    }

    /**
     * Gets reply_to_email
     *
     * @return string|null
     */
    public function getReplyToEmail()
    {
        return $this->container['reply_to_email'];
    }

    /**
     * Sets reply_to_email
     *
     * @param string|null $reply_to_email Optional Reply-To email address
     *
     * @return self
     */
    public function setReplyToEmail($reply_to_email)
    {

        if (is_null($reply_to_email)) {
            array_push($this->openAPINullablesSetToNull, 'reply_to_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('reply_to_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['reply_to_email'] = $reply_to_email;

        return $this;
    }

    /**
     * Gets cc_email
     *
     * @return string|null
     */
    public function getCcEmail()
    {
        return $this->container['cc_email'];
    }

    /**
     * Sets cc_email
     *
     * @param string|null $cc_email Optional CC email address
     *
     * @return self
     */
    public function setCcEmail($cc_email)
    {

        if (is_null($cc_email)) {
            array_push($this->openAPINullablesSetToNull, 'cc_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('cc_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['cc_email'] = $cc_email;

        return $this;
    }

    /**
     * Gets bcc_email
     *
     * @return string|null
     */
    public function getBccEmail()
    {
        return $this->container['bcc_email'];
    }

    /**
     * Sets bcc_email
     *
     * @param string|null $bcc_email Optional BCC email address
     *
     * @return self
     */
    public function setBccEmail($bcc_email)
    {

        if (is_null($bcc_email)) {
            array_push($this->openAPINullablesSetToNull, 'bcc_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('bcc_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['bcc_email'] = $bcc_email;

        return $this;
    }

    /**
     * Gets body
     *
     * @return string|null
     */
    public function getBody()
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param string|null $body The message body
     *
     * @return self
     */
    public function setBody($body)
    {

        if (is_null($body)) {
            array_push($this->openAPINullablesSetToNull, 'body');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('body', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        $this->container['body'] = $body;

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


