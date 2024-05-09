<?php

namespace App\Providers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();
        //
        Gate::define('admin', function(User $user): bool{
            if ($user->accountStatus == 'active') {
                return $user->isAdmin;
            }
            else{
                return 0;
            }   
        });
        Gate::define('status', function(User $user): bool{
            if ($user->accountStatus == 'active' || $user->accountStatus == 'new') {
                return 1;
            }
            else{
                return 0;
            }  
       });

       Expense::saved(function ($expense){
        if ($expense->service!=null) {
            $service = $expense->service;
            $totalExpense = $service->expenses()->sum('amount');
            $service->profit = $service->price - $totalExpense;
            $service->save();
        }
           
       });
    }
}
