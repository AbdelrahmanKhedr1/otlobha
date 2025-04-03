<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;


class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Fortify::createUsersUsing(CreateNewCustomer::class);
        // Fortify::updateUserProfileInformationUsing(UpdateCustomerProfileInformation::class);
        // Fortify::updateUserPasswordsUsing(UpdateCustomerPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetCustomerPassword::class);

        // Fortify::createUsersUsing(CreateNewDriver::class);
        // Fortify::updateUserProfileInformationUsing(UpdateDriverProfileInformation::class);
        // Fortify::updateUserPasswordsUsing(UpdateDriverPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetDriverPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });




        // Fortify::authenticateUsing(function (Request $request) {
        //     $admin = Admin::where('email', $request->email)->first();

        //     if ($admin && Hash::check($request->password, $admin->password)) {
        //         return $admin;
        //     }
        // });



        // // طلب رابط إعادة تعيين كلمة المرور لـ Customers
        // Fortify::requestPasswordResetLinkUsing(function (Request $request) {
        //     $request->validate(['email' => 'required|email']);

        //     $status = Password::broker('customers')->sendResetLink(
        //         $request->only('email')
        //     );

        //     return $status === Password::RESET_LINK_SENT
        //         ? response()->json(['message' => __($status)])
        //         : response()->json(['error' => __($status)], 422);
        // });

        // // إعادة تعيين كلمة المرور لـ Customers
        // Fortify::resetPasswordUsing(function (Request $request) {
        //     $request->validate([
        //         'email' => 'required|email',
        //         'password' => 'required|string|min:8|confirmed',
        //         'token' => 'required',
        //     ]);

        //     $status = Password::broker('customers')->reset(
        //         $request->only('email', 'password', 'password_confirmation', 'token'),
        //         function ($customer, $password) {
        //             $customer->forceFill([
        //                 'password' => bcrypt($password)
        //             ])->save();
        //         }
        //     );

        //     return $status === Password::PASSWORD_RESET
        //         ? response()->json(['message' => __($status)])
        //         : response()->json(['error' => __($status)], 422);
        // });

        // Fortify::authenticateUsing(function (Request $request) {
        //     $customer = Customer::where('email', $request->email)->first();

        //     if ($customer && Hash::check($request->password, $customer->password)) {
        //         return $customer;
        //     }
        //     return null;
        // });

        // Fortify::registerView(fn () => abort(404));  // منع عرض واجهة
    }
}
