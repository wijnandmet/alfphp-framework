<?php
namespace ALF;

use ALF\Traits\InstanceObject;

class View {
    use InstanceObject;

    private $_view;

    private function load(string $path) {
        $this->_view = [
            'path' => $path,
            'vars' => []
        ];
        return $this;
    }

    private function with($array) {
        $this->_view['vars'] = [...$array, ...$this->_view['vars']];
        return $this;
    }

    private function render() : string {
        foreach ($this->_view['vars'] AS $key => $value) {
            $$key = $value;
        };

        ob_flush();
        require('.' . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('/' , DIRECTORY_SEPARATOR, $this->_view['path']));
        return ob_get_clean();
    }

    private function renderFromPackage() : string {
        foreach ($this->_view['vars'] AS $key => $value) {
            $$key = $value;
        };

        ob_flush();
        require(rtrim(__DIR__, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $this->_view['path']));
        return ob_get_clean();
    }

    private function exist() {
        if (file_exists('./App/views/' . $this->_view['path'])) {
            return true;
        }
        return false;
    }
}