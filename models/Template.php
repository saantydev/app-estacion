<?php
class Template {
    private $template;
    private $vars = [];

    public function __construct($template) {
        $this->template = $template;
    }

    public function assign($name, $value) {
        $this->vars[$name] = $value;
    }

    public function render() {
        extract($this->vars);
        ob_start();
        include "views/{$this->template}.php";
        return ob_get_clean();
    }
}
?>