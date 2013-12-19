<?php
/**
 * Class TimeAgo
 *
 * Yii1 helper class
 * Formats date in seconds to passed time
 *
 * @license same as Yii itself
 * @author Ilya Zaytsev <zaytsew.ilya@gmail.com>
 *
 * @version 0.1
 *
 * @link https://github.com/akaiusagi/Yii-TimeAgo-helper
 */
class TimeAgo
{
	const WEEK = 604800;
	const DAY = 86400;
	const HOUR = 3600;
	const MINUTE = 60;

	/**
	 * Formats given time in seconds into string {n} time ago
	 *
	 * @param integer $time
	 * @param null|integer $now
	 * @return string
	 */
	public static function f($time, $now=null)
	{
		if(!isset($now))
		{
			$now = time();
		}

		$diff = $now - $time;

		if($diff < self::WEEK && $diff >= self::DAY)
		{
			return Yii::t('time_ago','{n} day ago|{n} days ago',array(floor($diff / self::DAY)));
		}
		elseif($diff < self::DAY && $diff >= self::HOUR)
		{
			return Yii::t('time_ago','{n} hour ago|{n} hours ago',array(floor($diff / self::HOUR)));
		}
		elseif($diff < self::HOUR && $diff >= self::MINUTE)
		{
			return Yii::t('time_ago','{n} minute ago|{n} minutes ago',array(floor($diff / self::MINUTE)));
		}
		elseif($diff < self::MINUTE) {
			return Yii::t('time_ago','{n} second ago|{n} seconds ago',array($diff));
		}
		elseif($diff == 0)
		{
			return 'Только что';
		}
		else
		{
			$date = new CDateFormatter(Yii::app()->locale);
			$pattern = date('Y', $now) == date('Y', $time) ? 'd MMM' : 'd MMM y';
			return $date->format($pattern, $time);
		}
	}
}

