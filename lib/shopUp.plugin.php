<?php

class shopUpPlugin extends shopPlugin {

    protected static $plugin;

    public function __construct($info) {
        parent::__construct($info);
        if (!self::$plugin) {
            self::$plugin = &$this;
        }
    }

    protected static function getThisPlugin() {
        if (self::$plugin) {
            return self::$plugin;
        } else {
            return wa()->getPlugin('up');
        }
    }

    public function frontendFooter() {
        if($this->getSettings('default_out')) {
            return self::display();
        }
    }

    public static function display() {
        $up = self::getThisPlugin();
        if ($up->getSettings('status')) {
            $view = wa()->getView();
            $img_exists = false;
            if (file_exists(wa()->getDataPath('plugins/up/up.png', 'shop'))) {
                $img_exists = true;
            }

            $view->assign('img_exists', $img_exists);
            $view->assign('settings', $up->getSettings());
            $template_path = wa()->getAppPath('plugins/up/templates/Up.html', 'shop');
            $html = $view->fetch($template_path);
            return $html;
        }
    }

}
