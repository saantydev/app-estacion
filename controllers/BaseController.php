<?php
require_once 'models/Template.php';

class BaseController {
    protected function render($view, $data = []) {
        $template = new Template($view);
        foreach ($data as $key => $value) {
            $template->assign($key, $value);
        }
        echo $template->render();
    }
}
?>