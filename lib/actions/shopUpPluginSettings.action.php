<?php

class shopUpPluginSettingsAction extends waViewAction
{
    protected $plugin_id = array('shop', 'up');
    
    public function execute()
    {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get($this->plugin_id);
        
        $img_exists = false;
        if(file_exists(wa()->getDataPath('plugins/up/up.png', 'shop'))) {
            $img_exists = true;
        }
        
        $this->view->assign('settings', $settings);
        $this->view->assign('img_exists', $img_exists);
    }
}