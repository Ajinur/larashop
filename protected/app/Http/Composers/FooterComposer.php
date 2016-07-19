<?php namespace App\Http\Composers;



use Illuminate\Contracts\View\View;

use App\Models\Information;

class FooterComposer

{

	public function compose(View $view)

	{

		$information =	Information::all();

		$view->with('information', $information);

	}

}