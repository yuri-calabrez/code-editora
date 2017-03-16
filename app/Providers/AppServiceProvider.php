<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::macro('error', function($field, $errors){
            if($errors->has($field)){
                return view('errors.error_field', compact(['field']));
            }
            return null;
        });

        \Html::macro('openFormGroup', function ($field = null, $errors = null){
           $hasError = ($field != null && $errors != null && $errors->has($field)) ? ' has-error' : '';
           return "<div class=\"form-group{$hasError}\">";
        });

        \Html::macro('closeFormGroup', function(){ return "</div>"; });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
