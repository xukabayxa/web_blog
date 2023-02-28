<?php

namespace App\Http\Controllers\Front;

use App\Http\Traits\ResponseTrait;
use App\Model\Admin\Banner;
use App\Model\Admin\Block;
use App\Model\Admin\BusinessSector;
use App\Model\Admin\CategorySpecial;
use App\Model\Admin\Contact;
use App\Model\Admin\InvestmentMarket;
use App\Model\Admin\Language;
use App\Model\Admin\Manufacturer;
use App\Model\Admin\Origin;
use App\Model\Admin\Partner;
use App\Model\Admin\PartnerCategory;
use App\Model\Admin\Policy;
use App\Model\Admin\PostCategorySpecial;
use App\Model\Admin\Project;
use App\Model\Admin\ProjectCategory;
use App\Model\Admin\Regent;
use App\Model\Admin\Store;
use App\Model\Admin\Tag;
use App\Model\Admin\Tagable;
use App\Model\Common\File;
use App\Model\Common\User;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Jenssegers\Agent\Agent;
use Vanthao03596\HCVN\Models\Province;
use Yajra\DataTables\DataTables;
use Validator;
use \stdClass;
use Response;
use App\Http\Controllers\Controller;
use App\Helpers\FileHelper;
use \Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Model\Admin\Category;
use App\Model\Admin\Product;
use App\Model\Admin\Post;
use App\Model\Admin\PostCategory;
use App\Model\Admin\Review;
use App\Model\Admin\Config;
use DB;
use Mail;
use SluggableScopeHelpers;
use Image;
use URL;

class FrontController extends Controller
{
    use ResponseTrait;

    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function resizeImage()
    {
        foreach (Post::orderBy('created_at','desc')->get() as $post) {
            $img = URL::to('/') .$post->image->path;
            Image::make($img)->resize(800, 600)->save();
            echo 'Thành công: ' . $post->image->path;
            echo "<br>";
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::query()->where(['status' => 1, 'is_main' => 1])->first();
        $config = Config::query()->first();
        $banner = Banner::query()->where(['page' => '1', 'status' => 1])->first();
        $posts = Post::query()->latest()->take(4)->get();

        return view('site.index', compact('user', 'banner', 'posts', 'config'));
    }

    public function posts(Request $request) {
        $posts = Post::query()->latest()->take(3)->get();
        $post_latest_id = @$posts[2] ?? new Post();
        $banner = Banner::query()->where(['page' => 2, 'status' => 1])->first();

        return view('site.posts', compact('posts', 'post_latest_id', 'banner'));
    }

    public function loadMorePost(Request $request)
    {
        $post_ids = Post::query()->where('status', 1)->pluck('id')->toArray();

        $posts = Post::where('status', 1)->whereIn('id', array_diff($post_ids, $request->post_ids_load_more))
            ->limit(3)->get();

        $html_post_render = '';
        foreach ($posts as $post) {
            $html_post_render .= view('site.partials.load_more_post', ['post' => $post])->render();
        }

        $post_ids = $posts->pluck('id');
        return response()->json(['success' => true, 'post_render' => $html_post_render,
            'post_ids' => $post_ids ]);
    }

    /**
     * trang chi tiết tin tức
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost($categorySlug, $slug)
    {
        $post = Post::findBySlug($slug);
        $user = User::query()->where(['status' => 1, 'is_main' => 1])->first();

        return view('site.post_detail', compact('post', 'user'));
    }

    public function changeLanguage($language)
    {
        \Session::put('language', $language);

        return redirect('/');
    }

    public function contact(Request $request)
    {
        $config = Config::query()->get()->first();

        return view('site.contact', compact('config'));
    }

    public function sendContact(Request $request)
    {
        $rule = [
            'user_name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ];

        $translate =
            [
                'user_name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không hợp lệ',
                'content.required' => 'Vui lòng nhập tin nhắn',
            ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            $translate
        );

        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            return Response::json($json);
        }

        $contact = new Contact();
        $contact->user_name = $request->user_name;
        $contact->email = $request->email;
        $contact->content = $request->content;
        $contact->address = $request->address;

        $contact->save();

        return $this->responseSuccess();
    }


}
