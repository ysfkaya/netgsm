<?php

namespace Brkphp\Netgsm;

use GuzzleHttp\Client;

class Account extends Netgsm
{
	const BALENCE_URL = 'https://api.netgsm.com.tr/balance/list/get/';

	public $client;

	public function __construct()
	{
		$this->client = new Client();
	}

	public function getBalence()
	{
		$response = $this->client->get(self::BALENCE_URL, [
			'query' => [
				'usercode' => config('netgsm.username'),
				'password' => config('netgsm.password'),
			],
		]);

		$content = $response->getBody()->getContents();

		if ($error = $this->checkError($content)) {
			return $this->handleContent($content);
		}

		return '0';
	}

	private function handleContent($content)
	{
		return explode(' ', $content, 3)[1];
	}
}