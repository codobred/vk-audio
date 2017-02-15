<?php


class View
{
    protected static $__this;

    protected $path;
    protected $ext;

    public function __construct($path = false)
    {
        $this->path = __DIR__ . '/../view';
        $this->ext = '.view.phtml';
    }

    public static function __callStatic($name, $arguments)
    {
        if (!self::$__this) self::$__this = new self;

        if (!method_exists(self::$__this, $name)) throw new \Exception('Undefined method: ' . $name);

        return call_user_func_array(array(self::$__this, $name), $arguments);
    }

    protected function make($layout = false, $template, array $vars = null)
    {
        if (is_array($vars)) extract($vars);

        ob_start();

        require_once $this->path . '/' . $template . $this->ext;

        $content = ob_get_clean();

        if (!$layout) {
            return $content;
        }

        ob_start();
        require_once $this->path . '/' . $layout . $this->ext;
        $html = ob_get_clean();

        return $html;
    }

}