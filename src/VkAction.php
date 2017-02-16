<?php

class VkAction
{
    protected $login;
    protected $pass;

    protected $client_id = "2274003";
    protected $client_secret = "hHbZxrka2uZ6jB1inYsH";

    protected $access_token;

    public function __construct($login, $pass)
    {
        $this->login = $login;
        $this->pass = $pass;

        $this->access_token = $this->__getToken();
    }

    /**
     * Get vk.com API access_token
     * @return string|null
     */
    protected function __getToken()
    {
        $data = $this->request("https://oauth.vk.com/token", array(
            'grant_type' => 'password',
            'scope' => 'audio,video',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'username' => $this->login,
            'password' => $this->pass,
        ));
        $data = json_decode($data, true);

        return (isset($data['access_token'])) ? $data['access_token'] : null;
    }

    /**
     * @param $url
     * @param array $params
     * @return string
     */
    protected static function request($url, array $params)
    {
        if (is_array($params) && count($params)) $url .= '?' . http_build_query($params);
        //echo $url;die;

        return file_get_contents($url);
    }
}