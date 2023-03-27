<?php

/**
 * @package Lock Recycled Topics
 * @version 1.0
 * @author Diego Andrés <diegoandres_cortes@outlook.com>
 * @copyright Copyright (c) 2023, SMF Tricks
 * @license https://www.mozilla.org/en-US/MPL/2.0/
 */

if (!defined('SMF'))
	die('No direct access...');

class LockRecycled
{
	/**
	 * Lock the removed topics
	 * 
	 * @uses integrate_remove_topics_before
	 * @param array $topics The removed topics
	 * @return void
	 */
	public static function lock_removed(array $topics) : void
	{
		global $smcFunc;

		// Locking them...
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}topics
			SET locked = {int:is_locked}
			WHERE id_topic IN ({array_int:topics})',
			array(
				'topics' => $topics,
				'is_locked' => 1,
			)
		);
	}
}