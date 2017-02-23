<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $fillable = ['title', 'description', 'create_date', 'due_date', 'completed', 'user_id', 'project_id'];
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d';
}
