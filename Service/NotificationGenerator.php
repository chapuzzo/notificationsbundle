<?php
namespace Chapuzzo\NotificationsBundle\Service;

use NNV\OneSignal\OneSignal;
use NNV\OneSignal\API\Notification;

class NotificationGenerator
{
	private $api_key;
	private $app_id;
	private $user_auth_key;

	public function __construct($api_key, $app_id, $user_auth_key)
	{
		$this->api_key = $api_key;
		$this->app_id = $app_id;
		$this->user_auth_key = $user_auth_key;
	}

	public function generate($text)
	{
		$oneSignal = new OneSignal($this->user_auth_key, $this->app_id, $this->api_key);
		$notification = new Notification($oneSignal);

		$notificationData = [
			'included_segments' => ['All'],
			'contents' => [
					'en' => 'Hello, world',
			],
			'data' => [
				'url' => 'http://todler.es'
			],
			'headings' => [
					'en' => $text,
			],
			'android_group' => 'bullshit',
			'collapse_id' => 'bullshit'
		];

		$notification->create($notificationData);
	}
}
