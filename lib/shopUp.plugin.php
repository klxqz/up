<?php


class shopUpPlugin extends shopPlugin
{

    public static function display()
    {
        $up = wa()->getPlugin('up');
        if($up->getSettings('status')) {
            $view = wa()->getView();
            $view->assign('settings',$up->getSettings());
            $template_path = wa()->getAppPath('plugins/up/templates/Up.html', 'shop');
            $html = $view->fetch($template_path);
            return $html;
        }
        
    }

}

