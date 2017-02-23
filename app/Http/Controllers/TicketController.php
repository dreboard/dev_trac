<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
class TicketController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function viewAllTickets()
	{
		$tickets = Ticket::all();

		return view("site/all_tickets", ["tickets"=>$tickets]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function viewTicketById($id)
	{
		$ticketInfo = Ticket::where('id', '=', $id)->get();
		//var_dump($ticketInfo); die();
		return view("site/view_ticket", ["ticketInfo" => $ticketInfo]);
		//return view('site/view_ticket', ['ticketInfo' => Ticket::findOrFail($id)]);
	}

	/**
	 * Create new ticket route
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function newTicketPage()
	{
		return view('site/new_project2');

	}

    /**
     * Save new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function newTicketSave(Request $request)
    {
	    $ticket = new Ticket;
    	$ticket->title = $request->input('title');
	    $ticket->description = $request->input('description');
	    $ticket->completed = $request->input('completed');
	    //$ticket->hours = $request->input('hours');
	    $ticket->create_date = date("Y-m-d", strtotime($request->input('create_date')));
	    $ticket->due_date = date("Y-m-d", strtotime($request->input('due_date')));
	    $ticket->user_id = $request->input('user_id');
	    $ticket->project_id = $request->input('project_id');

	    $ticket->save();
	    $insertedId = $ticket->id;

	    $ticketInfo = Ticket::where('id', '=', $insertedId)->get();;
	    return view("site/view_ticket", ["ticketInfo" => $ticketInfo]);
    }
}
