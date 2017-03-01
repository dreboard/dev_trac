<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
	protected $fillable = ['title', 'description', 'create_date', 'due_date', 'completed', 'user_id', 'project_id'];
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d';

	/**
	 * Last ten tickets by user.
	 *
	 * @param int $user_id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function viewLastTenTicketsById($user_id)
	{
		$result = DB::table('tickets')->where('user_id', 1)
		                     ->orderBy('title', 'desc')
		                     ->limit(10)
		                     ->get();
		return $result;
	}

}
