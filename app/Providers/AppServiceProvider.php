<?php

namespace App\Providers;

use App\Models\admin\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('student.layouts.base', function ($view) {
            $hideExamMenusForStudent = false;
            if (Auth::guard('student')->check()) {
                $courseId = (int) Auth::guard('student')->user()->sl_FK_of_course_id;
                $hideExamMenusForStudent = $courseId > 0 && Course::qualifiesForTypingCertificateById($courseId);
            }
            $view->with('hideExamMenusForStudent', $hideExamMenusForStudent);
        });
    }
}
