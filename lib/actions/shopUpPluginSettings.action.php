<?php

class shopUpPluginSettingsAction extends waViewAction {

    protected $plugin_id = array('shop', 'up');
    protected $tmp_path = 'plugins/up/templates/Up.html';

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get($this->plugin_id);

        $img_exists = false;
        if (file_exists(wa()->getDataPath('plugins/up/up.png', 'shop'))) {
            $img_exists = true;
        }
        $change_tpl = false;
        $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
        if (file_exists($template_path)) {
            $change_tpl = true;
        } else {
            $template_path = wa()->getAppPath($this->tmp_path, 'shop');
        }
        $template = file_get_contents($template_path);

        $this->view->assign('settings', $settings);
        $this->view->assign('img_exists', $img_exists);
        $this->view->assign('template', $template);
        $this->view->assign('change_tpl', $change_tpl);
    }

}
