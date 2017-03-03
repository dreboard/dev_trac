<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket, App\Helpers\DateHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{

	/**
	 * Ticket model
	 * @var string $ticket
	 */
	protected $ticket;

	/**
     * Create a new controller instance.
	 * Import ticket model class
	 *
	 * @todo Initiate middleware
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
	    $this->ticket = new Ticket;
    }

	/**
	 * Show all non closed tickets for view all.
	 *
	 * @todo create closed list with pagination
	 *
	 * @return \Illuminate\View\View
	 */
	public function viewAllTickets()
	{
		$tickets = Ticket::all();
		return view("site/all_tickets", ["tickets" => $tickets]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param int $id
	 * @return \Illuminate\View\View
	 */
	public function viewTicketById($id)
	{
		$ticketInfo = Ticket::where('id', '=', $id)->get();
		$viewLastTen = $this->ticket->viewLastTenTicketsById(1);
		return view("site/view_ticket", ["ticketInfo" => $ticketInfo, 'viewLastTen' => $viewLastTen]);
	}


	/**
	 * Create new ticket route
	 *
	 * @return void
	 */
	public function newTicketPage()
	{
		return view('site/newTicket');

	}

    /**
     * Save new ticket.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function newTicketSave(Request $request)
    {
	    $validator = Validator::make($request->all(), [
		    'title' => 'required|max:255',
		    'description' => 'required',
		    'create_date' => 'date',
	    ]);

	    if ($validator->fails()) {
		    return redirect('newTicket')
			    ->withErrors($validator)
			    ->withInput();
	    }
	    try{
		    $ticket = new Ticket;

		    $ticket->title = $request->input('title');
		    $ticket->description = $request->input('description');
		    $ticket->completed = $request->input('completed');
		    //$ticket->hours = $request->input('hours');

		    $ticket->create_date = DateHelper::formatStartDate($request->input('create_date'));
		    $ticket->due_date = DateHelper::formatEndDate($ticket->create_date, $request->input('due_date'));
		    $ticket->user_id = $request->input('user_id');
		    $ticket->project_id = $request->input('project_id');
		    $ticket->status = $request->input('status');
			$ticket->priority = $request->input('priority');

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
	 * @todo move update statement to Ticket model
	 * @param \Illuminate\Http\Request $request
	 * @return void
	 */
	public function editTicket(Request $request)
	{
		try{
			$ticket = new Ticket;
			$viewLastTen = $ticket->viewLastTenTicketsById($request->input('user_id'));
			try{
				$this->ticket->editTicketById($request->input('id'), $request);
			}catch (\Exception $e){
				$viewLastTen = $e->getMessage();
			}

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
	 * Search database for ticket.
	 * Search by string or ticket number
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return void
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
