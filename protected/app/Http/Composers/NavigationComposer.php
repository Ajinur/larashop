<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Models\Category;
use App\Models\Brands;

class NavigationComposer
{
	public function compose(View $view)
	{
		$category =	Category::with(['sub_cat' => function($query){
					    $query->orderBy('category_name');
					}])
					->where('status', 'A')
					->where('level', 0)
					->orderBy('category_name')
					->get();

		$brands   = Brands::with('product')->orderBy('brand_name')->get();
			
		$view->with('category', $category)->with('brands', $brands);
	}
}