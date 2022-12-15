<?php
/**
 * MetricAggregateQueryAsSubResourceAttributes
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
 * The version of the OpenAPI document: 2022-12-09
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
 * MetricAggregateQueryAsSubResourceAttributes Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MetricAggregateQueryAsSubResourceAttributes implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MetricAggregateQueryAsSubResource_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'metric_id' => 'string',
        'measurements' => 'string[]',
        'interval' => 'string',
        'page_size' => 'int',
        'by' => 'string[]',
        'return_fields' => 'string[]',
        'filter' => 'string[]',
        'timezone' => 'string',
        'sort' => 'string',
        'page_cursor' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'metric_id' => null,
        'measurements' => null,
        'interval' => null,
        'page_size' => null,
        'by' => null,
        'return_fields' => null,
        'filter' => null,
        'timezone' => null,
        'sort' => null,
        'page_cursor' => null
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
        'metric_id' => 'metric_id',
        'measurements' => 'measurements',
        'interval' => 'interval',
        'page_size' => 'page_size',
        'by' => 'by',
        'return_fields' => 'return_fields',
        'filter' => 'filter',
        'timezone' => 'timezone',
        'sort' => 'sort',
        'page_cursor' => 'page_cursor'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'metric_id' => 'setMetricId',
        'measurements' => 'setMeasurements',
        'interval' => 'setInterval',
        'page_size' => 'setPageSize',
        'by' => 'setBy',
        'return_fields' => 'setReturnFields',
        'filter' => 'setFilter',
        'timezone' => 'setTimezone',
        'sort' => 'setSort',
        'page_cursor' => 'setPageCursor'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'metric_id' => 'getMetricId',
        'measurements' => 'getMeasurements',
        'interval' => 'getInterval',
        'page_size' => 'getPageSize',
        'by' => 'getBy',
        'return_fields' => 'getReturnFields',
        'filter' => 'getFilter',
        'timezone' => 'getTimezone',
        'sort' => 'getSort',
        'page_cursor' => 'getPageCursor'
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

    public const MEASUREMENTS_COUNT = 'count';
    public const MEASUREMENTS_SUM_VALUE = 'sum_value';
    public const MEASUREMENTS_UNIQUE = 'unique';
    public const INTERVAL_DAY = 'day';
    public const INTERVAL_HOUR = 'hour';
    public const INTERVAL_MONTH = 'month';
    public const INTERVAL_WEEK = 'week';
    public const BY__ATTRIBUTED_CHANNEL = '$attributed_channel';
    public const BY__ATTRIBUTED_FLOW = '$attributed_flow';
    public const BY__ATTRIBUTED_MESSAGE = '$attributed_message';
    public const BY__ATTRIBUTED_VARIATION = '$attributed_variation';
    public const BY__CAMPAIGN_CHANNEL = '$campaign_channel';
    public const BY__FLOW = '$flow';
    public const BY__FLOW_CHANNEL = '$flow_channel';
    public const BY__MESSAGE = '$message';
    public const BY__MESSAGE_SEND_COHORT = '$message_send_cohort';
    public const BY__VARIATION = '$variation';
    public const BY__VARIATION_SEND_COHORT = '$variation_send_cohort';
    public const BY_BOUNCE_TYPE = 'Bounce Type';
    public const BY_CAMPAIGN_NAME = 'Campaign Name';
    public const BY_CLIENT_CANONICAL = 'Client Canonical';
    public const BY_CLIENT_NAME = 'Client Name';
    public const BY_CLIENT_TYPE = 'Client Type';
    public const BY_EMAIL_DOMAIN = 'Email Domain';
    public const BY_FAILURE_SOURCE = 'Failure Source';
    public const BY_FAILURE_TYPE = 'Failure Type';
    public const BY_FROM_NUMBER = 'From Number';
    public const BY_FROM_PHONE_REGION = 'From Phone Region';
    public const BY__LIST = 'List';
    public const BY_MESSAGE_NAME = 'Message Name';
    public const BY_MESSAGE_TYPE = 'Message Type';
    public const BY_METHOD = 'Method';
    public const BY_SUBJECT = 'Subject';
    public const BY_TO_NUMBER = 'To Number';
    public const BY_TO_PHONE_REGION = 'To Phone Region';
    public const BY_URL = 'URL';
    public const BY_FORM_ID = 'form_id';
    public const SORT__ATTRIBUTED_CHANNEL = '$attributed_channel';
    public const SORT___ATTRIBUTED_CHANNEL = '-$attributed_channel';
    public const SORT__ATTRIBUTED_FLOW = '$attributed_flow';
    public const SORT___ATTRIBUTED_FLOW = '-$attributed_flow';
    public const SORT__ATTRIBUTED_MESSAGE = '$attributed_message';
    public const SORT___ATTRIBUTED_MESSAGE = '-$attributed_message';
    public const SORT__ATTRIBUTED_VARIATION = '$attributed_variation';
    public const SORT___ATTRIBUTED_VARIATION = '-$attributed_variation';
    public const SORT__CAMPAIGN_CHANNEL = '$campaign_channel';
    public const SORT___CAMPAIGN_CHANNEL = '-$campaign_channel';
    public const SORT__FLOW = '$flow';
    public const SORT___FLOW = '-$flow';
    public const SORT__FLOW_CHANNEL = '$flow_channel';
    public const SORT___FLOW_CHANNEL = '-$flow_channel';
    public const SORT__MESSAGE = '$message';
    public const SORT___MESSAGE = '-$message';
    public const SORT__MESSAGE_SEND_COHORT = '$message_send_cohort';
    public const SORT___MESSAGE_SEND_COHORT = '-$message_send_cohort';
    public const SORT__VARIATION = '$variation';
    public const SORT___VARIATION = '-$variation';
    public const SORT__VARIATION_SEND_COHORT = '$variation_send_cohort';
    public const SORT___VARIATION_SEND_COHORT = '-$variation_send_cohort';
    public const SORT_BOUNCE_TYPE = 'Bounce Type';
    public const SORT_BOUNCE_TYPE = '-Bounce Type';
    public const SORT_CAMPAIGN_NAME = 'Campaign Name';
    public const SORT_CAMPAIGN_NAME = '-Campaign Name';
    public const SORT_CLIENT_CANONICAL = 'Client Canonical';
    public const SORT_CLIENT_CANONICAL = '-Client Canonical';
    public const SORT_CLIENT_NAME = 'Client Name';
    public const SORT_CLIENT_NAME = '-Client Name';
    public const SORT_CLIENT_TYPE = 'Client Type';
    public const SORT_CLIENT_TYPE = '-Client Type';
    public const SORT_EMAIL_DOMAIN = 'Email Domain';
    public const SORT_EMAIL_DOMAIN = '-Email Domain';
    public const SORT_FAILURE_SOURCE = 'Failure Source';
    public const SORT_FAILURE_SOURCE = '-Failure Source';
    public const SORT_FAILURE_TYPE = 'Failure Type';
    public const SORT_FAILURE_TYPE = '-Failure Type';
    public const SORT_FROM_NUMBER = 'From Number';
    public const SORT_FROM_NUMBER = '-From Number';
    public const SORT_FROM_PHONE_REGION = 'From Phone Region';
    public const SORT_FROM_PHONE_REGION = '-From Phone Region';
    public const SORT__LIST = 'List';
    public const SORT__LIST = '-List';
    public const SORT_MESSAGE_NAME = 'Message Name';
    public const SORT_MESSAGE_NAME = '-Message Name';
    public const SORT_MESSAGE_TYPE = 'Message Type';
    public const SORT_MESSAGE_TYPE = '-Message Type';
    public const SORT_METHOD = 'Method';
    public const SORT_METHOD = '-Method';
    public const SORT_SUBJECT = 'Subject';
    public const SORT_SUBJECT = '-Subject';
    public const SORT_TO_NUMBER = 'To Number';
    public const SORT_TO_NUMBER = '-To Number';
    public const SORT_TO_PHONE_REGION = 'To Phone Region';
    public const SORT_TO_PHONE_REGION = '-To Phone Region';
    public const SORT_URL = 'URL';
    public const SORT_URL = '-URL';
    public const SORT_COUNT = 'count';
    public const SORT_COUNT = '-count';
    public const SORT_FORM_ID = 'form_id';
    public const SORT_FORM_ID = '-form_id';
    public const SORT_SUM_VALUE = 'sum_value';
    public const SORT_SUM_VALUE = '-sum_value';
    public const SORT_UNIQUE = 'unique';
    public const SORT_UNIQUE = '-unique';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMeasurementsAllowableValues()
    {
        return [
            self::MEASUREMENTS_COUNT,
            self::MEASUREMENTS_SUM_VALUE,
            self::MEASUREMENTS_UNIQUE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getIntervalAllowableValues()
    {
        return [
            self::INTERVAL_DAY,
            self::INTERVAL_HOUR,
            self::INTERVAL_MONTH,
            self::INTERVAL_WEEK,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getByAllowableValues()
    {
        return [
            self::BY__ATTRIBUTED_CHANNEL,
            self::BY__ATTRIBUTED_FLOW,
            self::BY__ATTRIBUTED_MESSAGE,
            self::BY__ATTRIBUTED_VARIATION,
            self::BY__CAMPAIGN_CHANNEL,
            self::BY__FLOW,
            self::BY__FLOW_CHANNEL,
            self::BY__MESSAGE,
            self::BY__MESSAGE_SEND_COHORT,
            self::BY__VARIATION,
            self::BY__VARIATION_SEND_COHORT,
            self::BY_BOUNCE_TYPE,
            self::BY_CAMPAIGN_NAME,
            self::BY_CLIENT_CANONICAL,
            self::BY_CLIENT_NAME,
            self::BY_CLIENT_TYPE,
            self::BY_EMAIL_DOMAIN,
            self::BY_FAILURE_SOURCE,
            self::BY_FAILURE_TYPE,
            self::BY_FROM_NUMBER,
            self::BY_FROM_PHONE_REGION,
            self::BY__LIST,
            self::BY_MESSAGE_NAME,
            self::BY_MESSAGE_TYPE,
            self::BY_METHOD,
            self::BY_SUBJECT,
            self::BY_TO_NUMBER,
            self::BY_TO_PHONE_REGION,
            self::BY_URL,
            self::BY_FORM_ID,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSortAllowableValues()
    {
        return [
            self::SORT__ATTRIBUTED_CHANNEL,
            self::SORT___ATTRIBUTED_CHANNEL,
            self::SORT__ATTRIBUTED_FLOW,
            self::SORT___ATTRIBUTED_FLOW,
            self::SORT__ATTRIBUTED_MESSAGE,
            self::SORT___ATTRIBUTED_MESSAGE,
            self::SORT__ATTRIBUTED_VARIATION,
            self::SORT___ATTRIBUTED_VARIATION,
            self::SORT__CAMPAIGN_CHANNEL,
            self::SORT___CAMPAIGN_CHANNEL,
            self::SORT__FLOW,
            self::SORT___FLOW,
            self::SORT__FLOW_CHANNEL,
            self::SORT___FLOW_CHANNEL,
            self::SORT__MESSAGE,
            self::SORT___MESSAGE,
            self::SORT__MESSAGE_SEND_COHORT,
            self::SORT___MESSAGE_SEND_COHORT,
            self::SORT__VARIATION,
            self::SORT___VARIATION,
            self::SORT__VARIATION_SEND_COHORT,
            self::SORT___VARIATION_SEND_COHORT,
            self::SORT_BOUNCE_TYPE,
            self::SORT_BOUNCE_TYPE,
            self::SORT_CAMPAIGN_NAME,
            self::SORT_CAMPAIGN_NAME,
            self::SORT_CLIENT_CANONICAL,
            self::SORT_CLIENT_CANONICAL,
            self::SORT_CLIENT_NAME,
            self::SORT_CLIENT_NAME,
            self::SORT_CLIENT_TYPE,
            self::SORT_CLIENT_TYPE,
            self::SORT_EMAIL_DOMAIN,
            self::SORT_EMAIL_DOMAIN,
            self::SORT_FAILURE_SOURCE,
            self::SORT_FAILURE_SOURCE,
            self::SORT_FAILURE_TYPE,
            self::SORT_FAILURE_TYPE,
            self::SORT_FROM_NUMBER,
            self::SORT_FROM_NUMBER,
            self::SORT_FROM_PHONE_REGION,
            self::SORT_FROM_PHONE_REGION,
            self::SORT__LIST,
            self::SORT__LIST,
            self::SORT_MESSAGE_NAME,
            self::SORT_MESSAGE_NAME,
            self::SORT_MESSAGE_TYPE,
            self::SORT_MESSAGE_TYPE,
            self::SORT_METHOD,
            self::SORT_METHOD,
            self::SORT_SUBJECT,
            self::SORT_SUBJECT,
            self::SORT_TO_NUMBER,
            self::SORT_TO_NUMBER,
            self::SORT_TO_PHONE_REGION,
            self::SORT_TO_PHONE_REGION,
            self::SORT_URL,
            self::SORT_URL,
            self::SORT_COUNT,
            self::SORT_COUNT,
            self::SORT_FORM_ID,
            self::SORT_FORM_ID,
            self::SORT_SUM_VALUE,
            self::SORT_SUM_VALUE,
            self::SORT_UNIQUE,
            self::SORT_UNIQUE,
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
        $this->container['metric_id'] = $data['metric_id'] ?? null;
        $this->container['measurements'] = $data['measurements'] ?? null;
        $this->container['interval'] = $data['interval'] ?? null;
        $this->container['page_size'] = $data['page_size'] ?? 500;
        $this->container['by'] = $data['by'] ?? null;
        $this->container['return_fields'] = $data['return_fields'] ?? null;
        $this->container['filter'] = $data['filter'] ?? null;
        $this->container['timezone'] = $data['timezone'] ?? 'UTC';
        $this->container['sort'] = $data['sort'] ?? null;
        $this->container['page_cursor'] = $data['page_cursor'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['metric_id'] === null) {
            $invalidProperties[] = "'metric_id' can't be null";
        }
        if ($this->container['measurements'] === null) {
            $invalidProperties[] = "'measurements' can't be null";
        }
        if ($this->container['interval'] === null) {
            $invalidProperties[] = "'interval' can't be null";
        }
        $allowedValues = $this->getIntervalAllowableValues();
        if (!is_null($this->container['interval']) && !in_array($this->container['interval'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'interval', must be one of '%s'",
                $this->container['interval'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['filter'] === null) {
            $invalidProperties[] = "'filter' can't be null";
        }
        $allowedValues = $this->getSortAllowableValues();
        if (!is_null($this->container['sort']) && !in_array($this->container['sort'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'sort', must be one of '%s'",
                $this->container['sort'],
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
     * Gets metric_id
     *
     * @return string
     */
    public function getMetricId()
    {
        return $this->container['metric_id'];
    }

    /**
     * Sets metric_id
     *
     * @param string $metric_id The metric ID used in the aggregation
     *
     * @return self
     */
    public function setMetricId($metric_id)
    {
        $this->container['metric_id'] = $metric_id;

        return $this;
    }

    /**
     * Gets measurements
     *
     * @return string[]
     */
    public function getMeasurements()
    {
        return $this->container['measurements'];
    }

    /**
     * Sets measurements
     *
     * @param string[] $measurements Measurement key, e.g unique, sum_value, count
     *
     * @return self
     */
    public function setMeasurements($measurements)
    {
        $allowedValues = $this->getMeasurementsAllowableValues();
        if (array_diff($measurements, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'measurements', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['measurements'] = $measurements;

        return $this;
    }

    /**
     * Gets interval
     *
     * @return string
     */
    public function getInterval()
    {
        return $this->container['interval'];
    }

    /**
     * Sets interval
     *
     * @param string $interval Aggregation interval, e.g. hour, day, week, month
     *
     * @return self
     */
    public function setInterval($interval)
    {
        $allowedValues = $this->getIntervalAllowableValues();
        if (!in_array($interval, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'interval', must be one of '%s'",
                    $interval,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['interval'] = $interval;

        return $this;
    }

    /**
     * Gets page_size
     *
     * @return int|null
     */
    public function getPageSize()
    {
        return $this->container['page_size'];
    }

    /**
     * Sets page_size
     *
     * @param int|null $page_size Alter the maximum number of returned rows in a single page of aggregation results
     *
     * @return self
     */
    public function setPageSize($page_size)
    {
        $this->container['page_size'] = $page_size;

        return $this;
    }

    /**
     * Gets by
     *
     * @return string[]|null
     */
    public function getBy()
    {
        return $this->container['by'];
    }

    /**
     * Sets by
     *
     * @param string[]|null $by Optional attribute(s) used for partitioning by the aggregation function
     *
     * @return self
     */
    public function setBy($by)
    {
        $allowedValues = $this->getByAllowableValues();
        if (!is_null($by) && array_diff($by, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'by', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['by'] = $by;

        return $this;
    }

    /**
     * Gets return_fields
     *
     * @return string[]|null
     */
    public function getReturnFields()
    {
        return $this->container['return_fields'];
    }

    /**
     * Sets return_fields
     *
     * @param string[]|null $return_fields Provide fields to limit the returned data
     *
     * @return self
     */
    public function setReturnFields($return_fields)
    {
        $this->container['return_fields'] = $return_fields;

        return $this;
    }

    /**
     * Gets filter
     *
     * @return string[]
     */
    public function getFilter()
    {
        return $this->container['filter'];
    }

    /**
     * Sets filter
     *
     * @param string[] $filter List of filters, must include time range using ISO 8601 format (YYYY-MM-DDTHH:MM:SS.mmmmmm)           These filters follow a similar format to those in `GET` requests, the primary difference is that this endpoint asks for a list.         The time range can be filtered by providing a `greater_or_equal` filter on the datetime field, e.g `\"greater-or-equal(datetime,2021-07-01T00:00:00)\"`         and a `less-than` filter on the same datetime field, e.g. `\"less-than(datetime,2022-07-01T00:00:00)\"`.
     *
     * @return self
     */
    public function setFilter($filter)
    {
        $this->container['filter'] = $filter;

        return $this;
    }

    /**
     * Gets timezone
     *
     * @return string|null
     */
    public function getTimezone()
    {
        return $this->container['timezone'];
    }

    /**
     * Sets timezone
     *
     * @param string|null $timezone The timezone used for processing the query, e.g. `'America/New_York'`.               This field is validated against a list of common timezones from the [IANA Time Zone Database](https://www.iana.org/time-zones).               While most are supported, a few notable exceptions are `Factory`, `Europe/Kyiv` and `Pacific/Kanton`. This field is case sensitive.
     *
     * @return self
     */
    public function setTimezone($timezone)
    {
        $this->container['timezone'] = $timezone;

        return $this;
    }

    /**
     * Gets sort
     *
     * @return string|null
     */
    public function getSort()
    {
        return $this->container['sort'];
    }

    /**
     * Sets sort
     *
     * @param string|null $sort sort
     *
     * @return self
     */
    public function setSort($sort)
    {
        $allowedValues = $this->getSortAllowableValues();
        if (!is_null($sort) && !in_array($sort, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'sort', must be one of '%s'",
                    $sort,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['sort'] = $sort;

        return $this;
    }

    /**
     * Gets page_cursor
     *
     * @return string|null
     */
    public function getPageCursor()
    {
        return $this->container['page_cursor'];
    }

    /**
     * Sets page_cursor
     *
     * @param string|null $page_cursor page_cursor
     *
     * @return self
     */
    public function setPageCursor($page_cursor)
    {
        $this->container['page_cursor'] = $page_cursor;

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


