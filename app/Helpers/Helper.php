<?php

namespace App\Helpers;

class Helper
{


	public static function successMsg($type, $msg)
	{
		if ($type == 'insert') {
			Session()->flash('message', $msg . ' Insert Successfully !');
		} else if ($type == 'update') {
			Session()->flash('message', $msg . ' Update Successfully !');
		} else if ($type == 'delete') {
			Session()->flash('message', $msg . ' Delete Successfully !');
		} else if ($type == 'custom') {
			Session()->flash('message', $msg);
		}
	}

	public static function activeDeactiveMsg($type, $msg)
	{
		if ($type == 'active') {
			Session()->flash('message', $msg . ' Active Successfully !');
		} else {
			Session()->flash('message', $msg . ' Deactive Successfully !');
		}

		// if ($type == 'approve') {
		// 	Session()->flash('message', $msg . ' Approved Successfully !');
		// } else {
		// 	Session()->flash('message', $msg . ' Disapproved Successfully !');
		// }
	}

	public static function failarMsg($type, $msg)
	{
		if ($type == 'custom') {
			Session()->flash('failmessage', $msg);
		}
	}

}
