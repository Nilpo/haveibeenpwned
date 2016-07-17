<?php

/**
 * Settings file for HIBP (HaveIBeenPwned) API consumer class.
 * 
 * @author Rob Dunham <devnilpo@gmail.com>
 * @copyright 2016 Rob Dunham
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace HIBP;

/**
 * Defines a constant for the base URL of the HaveIBeenPwned API.
 *     GET https://haveibeenpwned.com/api/{service}/{parameter}
 *     api-version: 2
 */
const API_URL = 'https://haveibeenpwned.com/api/';

/**
 * Defines the current API version.
 */
const API_VERSION = '2';

/**
 * Determines whether the API version should be specified by supplying a custom
 * 'api-version' header or by using content negotiation. The default value of
 * false indicates that requests should use the custom header.
 */
const USE_CONTENT_NEGOTIATION = false;

/**
 * If content negotiation is implemented, specifies the value for the accept header.
 */
const ACCEPT_HEADER = 'application/vnd.haveibeenpwned.v2+json';

/**
 * Each request to the API must be accompanied by a user agent request header.
 * Typically, this should be the name of the app consuming the service. For
 * example, "Pwnage-Checker-For-PHP". A missing user agent header will result
 * in an HTTP 403 response.
 */
const USER_AGENT = '';

/**
 * Boolean value indicating whether responses should be returned as arrays. The default
 * is to parse them into PHP objects.
 */
const RESULT_AS_ARRAY = false;

// END