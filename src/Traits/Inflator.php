<?php

namespace ALF\Traits;

use Doctrine\Inflector\Inflector;
use \Doctrine\Inflector\InflectorFactory;

trait Inflator
{
	private Inflector $_inflator;

	private function loadInflator() {
		$this->_inflator = InflectorFactory::create()->build();
	}

	public function removeEndWord(string $fullWords, string $word) {
		if (substr($fullWords, 0, 5) === $word) {
			return substr($fullWords, 0, strlen($fullWords) - strlen($word));
		}
		return $fullWords;
	}

	public function pluralize(string $word) {
		$this->loadInflator();
		return $this->_inflator->pluralize($word);
	}

	public function singularize(string $word) {
		$this->loadInflator();
		return $this->_inflator->pluralize($word);
	}

	public function classify(string $word) {
		$this->loadInflator();
		return $this->_inflator->classify($word);
	}

	public function tableify(string $word) {
		$this->loadInflator();
		return $this->_inflator->tableize($word);
	}

	public function camelify(string $word) {
		$this->loadInflator();
		return $this->_inflator->camelize($word);
	}

	public function slugify(string $word) {
		$this->loadInflator();
		return $this->_inflator->urlize($word);
	}

	public function unaccentify(string $word) {
		$this->loadInflator();
		return $this->_inflator->unaccent($word);
	}
}