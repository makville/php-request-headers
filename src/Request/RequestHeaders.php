<?php

class RequestHeaders {

    public static function getRequestHeader($key, $prefix = null) {
        $requestHeaders = getallheaders();
        if (!is_null($key)) {
            $headers = $requestHeaders[$key];
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

}
