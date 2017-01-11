<?php

class HttpRequest {

    /**
    * @var User Agent
    */
    public $user_agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';

    /**
    * @var charset
    */
    private $charset = 'utf-8';


    public function __construct()
    {
    }

    /**
    * set user-agent
    *
    * @param string $user_agent
    * @return void
    */
    public function set_user_agent($user_agent)
    {
        $this->user_agent = $user_agent;
    }

    /**
    * file_get_contents with valid user-agent.
    *
    * @param string $url
    * @return string
    */
    public function response($url)
    {
        $options = array(
          'http' => array(
            'method' => 'GET',
            'header' => sprintf('User-Agent: %s', $this->user_agent)
          ),
        );
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }

    /**
    * parse dom_html
    *
    * @param string $html
    * @return object
    */
    private function dom($html)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', $this->charset));
        libxml_clear_errors();

        return $dom;
    }

    /**
    * dom_xpath
    *
    * @param string $html
    * @return object
    */
    public function dom_xpath($html)
    {
        $dom = self::dom($html);
        return new \DOMXpath($dom);
    }

    /**
    * get element by xpath
    *
    * @param string target_xpath
    * @param object $dom_xpath
    * @return array
    */
    public function elements($target_xpath, $dom_xpath)
    {
        echo $this->user_agent;
        return $dom_xpath->query($target_xpath);
    }

}
