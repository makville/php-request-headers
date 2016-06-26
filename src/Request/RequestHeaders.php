<?php
namespace Makville\RequestHeaders\Request;

class RequestHeaders {

    public static function getRequestHeader($key, $prefix = null) {
        $requestHeaders = self::getAllHeaders();
        $header = null;
        if (!is_null($key)) {
            $headers = (isset($requestHeaders[$key])) ? $requestHeaders[$key] : null;
            $parts = explode(',', $headers);
            if (is_array($parts)) {
                foreach ($parts as $part) {
                    if (strpos($part, $prefix . ' ') !== false) {
                        $header = trim($part);
                        break;
                    }
                }
            }
        }
        return $header;
    }

    public static function getHeaderValue($header) {
        $parts = explode(' ', $header);
        return array_pop($parts);
    }

    public static function getAllHeaders() {
        $headers = '';
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        if (function_exists('apache_request_headers')) {
            return array_merge($headers, apache_request_headers());
        }
        return $headers;
    }
}
