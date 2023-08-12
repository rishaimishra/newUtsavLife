<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // http to https
         $url=url()->full();
         if(strstr($url, "http://")){
            $url=str_replace("http://", "https://", $url);
            ?>
            <script>
                window.location='<?php  echo $url ?>';
            </script>

            <?php
         }

    }
}
