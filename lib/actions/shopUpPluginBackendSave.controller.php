<?php

class shopUpPluginBackendSaveController extends waJsonController {

    public function execute() {

        $app_settings_model = new waAppSettingsModel();
        $shop_up = waRequest::post('shop_up');
        foreach ($shop_up as $name => $val) {
            $app_settings_model->set(array('shop', 'up'), $name, $val);
        }

        $file = waRequest::file('img');
        if ($file->uploaded()) {
            $image_path = wa()->getDataPath('plugins/up/', 'shop');
            $name = 'up.png';
            try {
                $file->waImage()->save($image_path . $name);
                $this->response['preview'] = wa()->getDataUrl('plugins/up/' . $name, true, 'shop');
            } catch (Exception $e) {

                $this->setError($e->getMessage());
            }
        }
    }

}
