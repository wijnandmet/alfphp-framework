<?php
namespace ALF;

use \ALF\Traits\InstanceObject;
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class View {
    use InstanceObject;

    private Environment $_twig;
	private array $_vars = [];
	private string $_file;

    private function load(string $path) {
		$loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/App/views/');
		$this->_twig = new Environment($loader);
		$this->addFrameworkMethods();
		$this->_file = $path;
		if (strpos($path, '.twig') === false) {
			$this->_file .= '.twig';
		}
        return $this;
    }

    private function with($array) {
        $this->_vars = [...$array, ...$this->_vars];
        return $this;
    }

    private function render() : string {

		echo '<pre>';
		print_r($this->_vars);
		echo '</pre>';

		return $this->_twig->render($this->_file, $this->_vars);
    }

	private function addFrameworkMethods() {
		$methods = ['lang', 'env', 'debug'];
		foreach ($methods AS $methodname) {
			$this->_twig->addFunction(new TwigFunction($methodname, function ($asset) use ($methodname) {
				$params = func_get_args();
				return call_user_func_array($methodname,$params);
			}));
		};
	}

 /*   private function exist() {
        if (file_exists('./App/views/' . $this->_view['path'])) {
            return true;
        }
        return false;
    }*/
}