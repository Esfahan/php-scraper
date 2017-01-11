# Scraper
get DOM elements from http response with PHP.

## Requirements
- php5.5+

## Usage
get DOM elements

```
<?php
require_once(dirname(__FILE__) . '/http_request.php');

// set target url
$url = '{url}';
// set target url
$target_xpath = '{xpath}';

// request
$request = new HttpRequest();

// set user_agent
$request->user_agent = 'set your user agent'

// get response
$response = $request->response($url);

// get dom
$dom_xpath = $request->dom_xpath($response);

// get target dom
$elements = $request->elements($target_xpath, $dom_xpath);

// get elements
$items = [];
foreach ($elements as $element) {
    $items[] = array(
        'text' => $element->nodeValue,
        'href' => $element->getAttribute('href')
        );
}

// convert array into json
echo json_encode($items);
```
