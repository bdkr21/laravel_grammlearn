<?php
// providers/AppServiceProvider.php
namespace App\Providers;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ResetPassword::createUrlUsing(function (User $user, string $token) {
        //     return 'https://example.com/reset-password?token='.$token;
        // });
    }
}
