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

    public function audioSearch($q, $page = 0, $limit = 15)
    {
        $page = max($page, 1);
        $offset = ($page <= 1) ? 0 : $page * $limit;

        $data = $this->wrapper('audio.search', array(
            'q' => $q,
            'limit' => $limit,
            'offset' => $offset,
        ));

        return (isset($data['response']['items'][0]))
            ? $data['response']
            : null
        ;
    }

    protected function wrapper($method, $params)
    {
        $data = json_decode(self::request('https://api.vk.com/method/'.$method, array_merge(array(
            'v' => '5.0',
            'access_token' => $this->access_token,
        ), $params)), true);

        if (isset($data['error'])) {
            var_dump($data);
            die;
        }
        
        return $data;
    }

    /**
     * Get vk.com API access_token
     * @return string|null
     */
    protected function __getToken()
    {
        return Cache::get('access_token', function() {
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
        }, 60*60*24*5);
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