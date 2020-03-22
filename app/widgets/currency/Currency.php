<?php

namespace app\widgets\currency;
use app\core\base\Model;
use app\core\Db;

class Currency extends Model
{
	private $currency;
	private $currencies;
	private $tpl = __DIR__ . '/tpl/currency.php';

	function __construct()
	{
		$this->run();
	}

	private function run()
	{
		$this->currency   = $_SESSION['currency'];
		$this->currencies = $_SESSION['currencies'];

		echo $this->getHtml();
	}

	static function getCurrencies()
	{
		$stmt = Db::query('SELECT code, title, symbol, value, base FROM currency ORDER BY base DESC');
		return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
	}

	static function getCurrency($currencies)
	{
		if (isset($_COOKIE['currency']) AND array_key_exists($_COOKIE['currency'], $currencies)) {
			$key 	= $_COOKIE['currency'];
		} else $key = key($currencies);

		$currency 		  = $currencies[$key];
		$currency['code'] = $key;

		return $currency;
	}

	private function getHtml()
	{
		require_once $this->tpl;
	}
}