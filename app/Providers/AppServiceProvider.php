<?php

namespace App\Providers;
use App\Http\View\Composers\FooterComposer;
use App\Http\View\Composers\HeaderComposer;
use App\Http\View\Composers\MenuHomePageComposer;
use Illuminate\Support\Facades\Schema; //SoftDelete
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = \App\Model\Admin\Config::with(['image'])->where('id',1)->first();
        view()->share('config', $config);

        \Illuminate\Database\Query\Builder::macro('toRawSql', function(){
			return array_reduce($this->getBindings(), function($sql, $binding){
				return preg_replace('/\?/', is_numeric($binding) ? $binding : "'".$binding."'" , $sql, 1);
			}, $this->toSql());
		});

		\Illuminate\Database\Eloquent\Builder::macro('toRawSql', function(){
			return ($this->getQuery()->toRawSql());
		});

        View::composer(
            'site.partials.header',
            MenuHomePageComposer::class
        );

        View::composer(
            'site.index',
            MenuHomePageComposer::class
        );

        View::composer(
            'site.partials.footer',
            FooterComposer::class
        );

        View::composer(
            'site.partials.header',
            HeaderComposer::class
        );

        View::composer(
            'site.layouts.master',
            HeaderComposer::class
        );

        View::composer(
            'site.partials.single_product',
            HeaderComposer::class
        );

        View::composer(
            'site.layouts.master',
            FooterComposer::class
        );
    }
}
