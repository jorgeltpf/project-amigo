<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Article;
use App\ArticleCategory;
use App\User;
use App\Video;
use App\VideoAlbum;
use App\Photo;
use App\PhotoAlbum;
use App\Models\Establishment;
use App\Models\Product;
use App\Models\Promotion;

class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

	public function index() {
        $title = "Dashboard";

        $establishments = Establishment::count();
        $products = Product::count();
        $promotions = Promotion::count();
        $news = Article::count();
        $newscategory = ArticleCategory::count();
        $users = User::count();
        $photo = Photo::count();
        $photoalbum = PhotoAlbum::count();
        $video = Video::count();
        $videoalbum = VideoAlbum::count();
		return view('admin.dashboard.index',  compact('title','news','newscategory','video','videoalbum','photo',
            'photoalbum','users', 'establishments', 'products', 'promotions'));
	}
}