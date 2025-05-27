<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalCategories = 2;
        $totalUsers = 2;
        $todayViews = 2;

        return view('dashboard.index', compact(
            'totalArticles',
            'totalCategories',
            'totalUsers',
            'todayViews'
        ));
    }
}
