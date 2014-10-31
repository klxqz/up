<?php

class shopUpPluginBackendSaveController extends waJsonController {

    protected $tmp_path = 'plugins/up/templates/Up.html';
    protected $plugin_id = array('shop', 'up');

    public function execute() {

        $app_settings_model = new waAppSettingsModel();
        $shop_up = waRequest::post('shop_up', array());
        foreach ($shop_up as $name => $val) {
            $app_settings_model->set($this->plugin_id, $name, $val);
        }

        if(waRequest::post('delete')) {
            $image_path = wa()->getDataPath('plugins/up/up.png', 'shop');
            @unlink($image_path);
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
        if (!empty($shop_up['reset_tpl'])) {
            $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
            @unlink($template_path);
        } else {
            $post_template = waRequest::post('template');
            if ($post_template) {
                $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
                if (!file_exists($template_path)) {
                    $template_path = wa()->getAppPath($this->tmp_path, 'shop');
                }
                $template = file_get_contents($template_path);
                if ($template != $post_template) {
                    $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);

                    $f = fopen($template_path, 'w');
                    if (!$f) {
                        throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись ' . $template_path);
                    }
                    fwrite($f, $post_template);
                    fclose($f);
                }
            }
        }
    }

}
