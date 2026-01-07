<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Igreja;
use App\Models\Membro;
use App\Models\Ministerio;
use App\Models\Product;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = User::count();
        view()->share('user',$user);
        
        $category = Category::count();
        view()->share('category',$category);
        
        $product = Product::count();
        view()->share('product',$product);
        
        $collection = Collection::count();
        view()->share('collection',$collection);

        $igrejas = Igreja::count();
        view()->share('igrejas',$igrejas);

        $membros = Membro::count();
        view()->share('membros',$membros);

        $ministerios = Ministerio::count();
        view()->share('ministerios',$ministerios);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
