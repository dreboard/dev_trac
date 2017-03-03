<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Ticket
 *
 * @todo Create getTicketById
 *
 * Ticket Model
 * @package App\Model
 */
class Ticket extends Model
{
	protected $fillable = ['title', 'description', 'create_date', 'due_date', 'completed', 'user_id', 'project_id', 'status', 'priority'];
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d';

	/**
	 * Last ten tickets by user.
	 *
	 * @param int $user_id
	 * @return array $result
	 */
	public function viewLastTenTicketsById($user_id)
	{
		$result = DB::table('tickets')->where('user_id', 1)
			->where("status", "<>", "closed")
		                     ->orderBy('title', 'desc')
		                     ->limit(10)
		                     ->get();
		return $result;
	}

	/**
	 * Last ten tickets by user.
	 *
	 * @param int $id
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array $result
	 */
	public function editTicketById( $id, Request $request ) {
		$result = DB::table( 'tickets' )->where('id', '=', (int) $id)
		      ->update([
			      'title' => $request->input('title'),
			      'description' => $request->input('description'),
			      'create_date' => date("Y-m-d", strtotime($request->input('create_date'))),
			      'due_date' => date("Y-m-d", strtotime($request->input('due_date'))),
			      'completed' => $request->input('completed'),
			      'project_id' => (int)$request->input('project_id'),
			      'user_id' => (int)$request->input('user_id'),
			      'status' => $request->input('status'),
			      'priority' => $request->input('priority'),
		      ]);

		return $result;
	}

	/**
	 * Last ten tickets by user.
	 *
	 * @param string $keyword
	 * @return array $result
	 */
	public function getTicketSearchResults( $keyword ) {
		$result = DB::table( 'tickets' )->where( "title", "LIKE", "%$keyword%" )
			->where("status", "<>", "closed")
		    ->orWhere( "id", "LIKE", "%$keyword%" )
			->orderBy( 'id', 'desc' )
		     ->limit( 25 )
		     ->get();

		return $result;
	}
}
