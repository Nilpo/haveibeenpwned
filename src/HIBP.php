<?php

namespace HIBP;

use \Httpful\Request;

require_once(__DIR__ . '/../settings.php');

/**
 * Provides a simple consumer for the HaveIBeenPwned API. Tested and working with API v2.
 * 
 * @author Rob Dunham <devnilpo@gmail.com>
 * @copyright 2016 Rob Dunham
 * @license https://opensource.org/licenses/MIT MIT License
 */
class HIBP {

    /**
     * Returns a list of all breaches that a particular account has been involved in.
     * 
     * @param string An email or user name to check.
     * @param boolean Indicates whether the response should be truncated, optional.
     * @param string Filters results to the specified domain, optional.
     * @return mixed Returns an empty string or an array of objects.
     */
    public static function getAllBreaches($account, $truncate = false, $domain = null) {
        $uri = API_URL . "breachedaccount/{$account}?";
        $params = array();

        if ($truncate === true) {
            $params['truncateResponse'] = true;
        }

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if (count($params)) {
            $uri .= http_build_query($params);
        }

        return self::sendRequest($uri);
    }

    /**
     * Returns the details of each breach in the system.
     * 
     * @param string Filters results to the specified domain, optional.
     * @return mixed Returns an empty string or an array of objects.
     */
    public static function getAllBreachedSites($domain = null) {
        $uri = API_URL . "breaches?";
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if (count($params)) {
            $uri .= http_build_query($params);
        }

        return self::sendRequest($uri);
    }

    /**
     * Returns the details of a single breach.
     * 
     * @param string The "name" of the breach to return.
     * @return mixed Returns an empty string or an array of objects.
     */
    public static function getBreachedSite($name) {
        $uri = API_URL . "breach/{$name}";

        return self::sendRequest($uri);
    }

    /**
     * Returns an alphabetical list of data classes that represent the data that was
     * compromised during a breach.
     * 
     * @return array Returns a string array of data classes.
     */
    public static function getDataClasses() {
        $uri = API_URL . "dataclasses";

        return self::sendRequest($uri);
    }

    /**
     * Returns all pastes associated with a specified email address.
     * 
     * @param string An email address to check.
     * @return mixed Returns an empty string or an array of objects.
     */
    public static function getAllPastes($account) {
        $uri = API_URL . "pasteaccount/{$account}?";

        return self::sendRequest($uri);
    }

    /**
     * Sends an HTTP request and returns a response.
     * 
     * @param string A valid API URI.
     * @return mixed Returns an empty string or an array of objects.
     */
    private static function sendRequest($uri) {
        if (RESULT_AS_ARRAY === true) {
            \Httpful\Httpful::register(\Httpful\Mime::JSON, new \Httpful\Handlers\JsonHandler(array('decode_as_array' => true)));
        }

        $request = Request::get($uri);

        if (USE_CONTENT_NEGOTIATION === false) {
            $request->addHeaders(array(
                'api-version' => API_VERSION,
                'User-Agent' => USER_AGENT
            ));
        } else {
            $request->addHeaders(array(
                'Accept' => ACCEPT_HEADER,
                'User-Agent' => USER_AGENT
            ));
        }

        $response = $request->send();

        self::checkResponseCode($response);

        return $response->body;
    }

    /**
     * Checks the HTTP response code for the response and throws an exception in the
     * event of an error.
     * 
     * @param \Httpful\Response A parsed Httpful Response object.
     * @throws \Exception Indicates an error state based on HTTP response codes.
     */
    private static function checkResponseCode($response) {
        switch($response->code) {
            case 200:
                // Ok — everything worked and there's a string array of pwned sites for the account
                return;
            case 400:
                // Bad request — the account does not comply with an acceptable format (i.e. it's an empty string)
                throw new \Exception(BAD_INPUT_TYPE_ERROR);
                return;
            case 403:
                // Forbidden — no user agent has been specified in the request
                throw new \Exception(NO_USER_AGENT_ERROR);
                return;
            case 404:
                // Not found — the account could not be found and has therefore not been pwned
                throw new \Exception(NO_BREACHES_FOUND_MSG);
                return;
        }
    }

}

// END