<?php



namespace App\Providers;



use Illuminate\Support\ServiceProvider;



class ViewComposerServiceProvider extends ServiceProvider

{

    /**

     * Bootstrap the application services.

     *

     * @return void

     */

    public function boot()

    {

        $this->buatSidebar();

        $this->buatTopMenu();

        $this->buatFooter();

    }



    /**

     * Register the application services.

     *

     * @return void

     */

    public function register()

    {

        //

    }



    private function buatSidebar()

    {

        view()->composer('includes.left-sidebar', 'App\Http\Composers\NavigationComposer');

    }



    private function buatTopMenu()

    {

        view()->composer('includes.menu', 'App\Http\Composers\NavigationComposer');

    }

    private function buatFooter()

    {

        view()->composer('includes.footer', 'App\Http\Composers\FooterComposer');

    }

}

