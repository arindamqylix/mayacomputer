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
                $user = Auth::guard('student')->user();
                $regNo = (string) $user->sl_reg_no;
                $centerId = (int) $user->sl_FK_of_center_id;
                $enrollments = student_course_enrollment_rows($centerId, null)
                    ->filter(fn ($row) => (string) $row->sl_reg_no === $regNo);
                $hasNonTypingCourse = $enrollments->contains(
                    fn ($row) => !Course::qualifiesForTypingCertificateById((int) $row->course_id)
                );
                $hideExamMenusForStudent = $enrollments->isNotEmpty() && !$hasNonTypingCourse;
            }
            $view->with('hideExamMenusForStudent', $hideExamMenusForStudent);
        });
    }
}
