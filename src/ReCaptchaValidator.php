<?php
namespace FormGuide\Handlx;

class ReCaptchaValidator
{
	private $disabled;
	private $secret;
	public function __construct()
	{
		$this->disabled=false;
	}
	
	public function isDisabled()
	{
		return $this->disabled;	
	}

	public function disable($enable)
	{
		$this->disabled = $disable;
	}

	public function initSecretKey($key)
	{
		$this->secret = $key;
	}

	public function validate()
	{
		if(empty($_POST['g-recaptcha-response']))
		{
			return false;
		}

		$captcha=$_POST['g-recaptcha-response'];

		$url = 
		'https://www.google.com/recaptcha/api/siteverify?secret='.$this->secret.'&response='.$captcha.'&remoteip='.$_SERVER['REMOTE_ADDR'];

		$resp_raw = file_get_contents($url);

		$response=json_decode($resp_raw, true);

		if(!empty($response['success']) && $response['success'])
		{
			return true;
		}
		return false;
	}
}