<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket, App\Helpers\SiteHelper;


class TicketController extends Controller
{

	protected $ticket;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
	    $this->ticket = new Ticket;
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
		$viewLastTen = $this->ticket->viewLastTenTicketsById(1);
		return view("site/view_ticket", ["ticketInfo" => $ticketInfo, 'viewLastTen' => $viewLastTen]);
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

	    try{
		    $ticket = new Ticket;

		    //var_dump($ticket->viewLastTenTicketsById($request->input('user_id'))); die();

		    $ticket->title = $request->input('title');
		    $ticket->description = $request->input('description');
		    $ticket->completed = $request->input('completed');
		    //$ticket->hours = $request->input('hours');

		    $ticket->create_date = SiteHelper::formatStartDate($request->input('create_date'));
		    $ticket->due_date = SiteHelper::formatEndDate($ticket->create_date, $request->input('due_date'));
		    $ticket->user_id = $request->input('user_id');
		    $ticket->project_id = $request->input('project_id');
		    $ticket->status = $request->input('status');

		    $ticket->save();
		    $insertedId = $ticket->id;
		    $viewLastTen = $ticket->viewLastTenTicketsById($request->input('user_id'));
		    $ticketInfo = Ticket::where('id', '=', $insertedId)->get();
		    return view("site/view_ticket", ["ticketInfo" => $ticketInfo, 'viewLastTen' => $viewLastTen]);
	    } catch (\Exception $e){
			echo $e->getMessage();
	    } catch (\Error $er){
	    	echo $er->getMessage();
	    }

    }

	/**
	 * Edit ticket.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function editTicket(Request $request)
	{
		try{
			$ticket = new Ticket;
			$viewLastTen = $ticket->viewLastTenTicketsById($request->input('user_id'));
			Ticket::where('id', '=', (int) $request->input('id'))
			      ->update([
				      'title' => $request->input('title'),
				      'description' => $request->input('description'),
				      'create_date' => date("Y-m-d", strtotime($request->input('create_date'))),
				      'due_date' => date("Y-m-d", strtotime($request->input('due_date'))),
				      'completed' => $request->input('completed'),
				      'project_id' => (int)$request->input('project_id'),
				      'user_id' => (int)$request->input('user_id'),
				      'status' => $request->input('status')
			      ]);

			$ticketInfo = Ticket::where('id', '=', (int) $request->input('id'))->get();
			return view("site/view_ticket")
				->with('ticketInfo', $ticketInfo)
				->with('viewLastTen',$viewLastTen);
		} catch (\Exception $e){
			echo $e->getMessage();
		} catch (\Error $er){
			echo $er->getMessage();
		}

	}

	/**
	 * Edit ticket.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ticketSearch(Request $request)
	{
		try{
			$keyword = filter_var($request->input('keyword'), FILTER_SANITIZE_STRING);

			try{
				$searchResults = $this->ticket->getTicketSearchResults($keyword);
			}catch (\Exception $e){
				$searchResults = $e->getMessage();
			}

			if(!$searchResults){
				$searchResults = "No ticket found";
			}

		} catch (\Exception $e){
			$searchResults = $e->getMessage();
		} catch (\Error $er){
			$searchResults = $er->getMessage();
		}finally {
			return view("site/view_search", ["searchResults" => $searchResults]);
		}


	}
}
