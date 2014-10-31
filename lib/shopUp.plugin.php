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
        if ($this->getSettings('default_output')) {
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

            $tmp_path = 'plugins/up/templates/Up.html';
            $template_path = wa()->getDataPath($tmp_path, false, 'shop', true);
            if (!file_exists($template_path)) {
                $template_path = wa()->getAppPath($tmp_path, 'shop');
            }

            $html = $view->fetch($template_path);
            return $html;
        }
    }

}
