<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Pages;
use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Share
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $data['categories'] = Category::all();
        $data['settings'] = Settings::all();
        $data['pages'] = Pages::all();
        foreach ($data['settings'] as $key) {
            $settings[$key->settings_key] = $key->settings_value;
        }
//        foreach ($data['categories'] as $category) {
//            $settings[$category->category_name] = $category;
//        }


        View::share($settings);

        return $next($request);
    }
}
