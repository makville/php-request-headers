<?php
class RequestHeaders {

	public function __construct () {
	
	}
	
	public function getRequestHeader ($key, $part = null ) {
		$header;
		$requestHeaders = getallheaders();
        $headers = $requestHeaders[$key];
        $parts = explode(',', $headers);
        foreach ($parts as $part ) {
            if (strpos($part, $part . ' ') !== false ) {
                $header = trim($part);
                break;
            }
        }
        return $header;
	}
}

