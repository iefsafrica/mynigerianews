<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\Http\Requests\UpdatePaymentCredentialsRequest;

class SettingController extends AppBaseController
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * SettingController constructor.
     */
    public function __construct(SettingRepository $SettingRepository)
    {
        $this->settingRepository = $SettingRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $setting = Setting::pluck('value', 'key')->toArray();
        $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();
        $sectionName = ($request->get('section') === null) ? 'general' : $request->get('section');

        return view("setting.$sectionName",
            compact('sectionName', 'setting', 'selectedPaymentGateways'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateSettingRequest $request): RedirectResponse
    {

         $input = $request->all();
        if ($input['sectionName'] == 'general_1') {
            if ($request->show_captcha == null) {
                $input['show_captcha'] = '0';
            } else {
                $this->validate($request, [
                    'site_key' => 'required',
                    'secret_key' => 'required',
                ]);
            }
        }

        $id = Auth::id();
        $this->settingRepository->update($input, $id);

        Flash::success(__('messages.placeholder.settings_updated_successfully'));

        return Redirect::back();
    }

//     public function paymentUpdate(Request $request): RedirectResponse
//     {
//         $paymentGateways = $request->payment_gateway;

//         PaymentGateway::query()->delete();

//         if (isset($paymentGateways)) {
//             foreach ($paymentGateways as $paymentGateway) {
//                 PaymentGateway::updateOrCreate(['payment_gateway_id' => $paymentGateway],
//                     [
//                         'payment_gateway' => Plan::PAYMENT_METHOD[$paymentGateway],
//                     ]);
//             }
//             Flash::success(__('messages.placeholder.settings_updated_successfully'));

//             return Redirect::back();
//         }
//     }
         public function paymentUpdate(Request $request)
         {
                  $inputs = $request->all();
                  $inputs['stripe_checkbox_btn'] = isset($inputs['stripe_checkbox_btn']) ? 1 : 0;
                  $inputs['paypal_checkbox_btn'] = isset($inputs['paypal_checkbox_btn']) ? 1 : 0;
                  $inputs['manually_checkbox_btn'] = isset($inputs['manually_checkbox_btn']) ? 1 : 0;

                  foreach($inputs as $key => $value) {
                           $value = $value ?? '';
                           $setting = Setting::where('key', '=', $key)->first();

                           if(empty($setting)) {
                                    Setting::create([
                                             'key' => $key,
                                             'value' => $value,
                                    ]);
                           } else {
                                    $setting->update([
                                             'value' => $value,
                                    ]);
                           }
                  }

                  // Redirect back with a success message
                  Flash::success(__('messages.placeholder.settings_updated_successfully'));

                  return redirect()->back();
         }
         public function openAiKeyupdate(Request $request)
         {
                  $inputs = $request->all();

                  foreach($inputs as $key => $value) {
                           $value = $value ?? '';
                           $setting = Setting::where('key', '=', $key)->first();

                           if(empty($setting)) {
                                    Setting::create([
                                             'key' => $key,
                                             'value' => $value,
                                    ]);
                           } else {
                                    $setting->update([
                                             'value' => $value,
                                    ]);
                           }
                  }

                  // Redirect back with a success message
                  Flash::success(__('messages.placeholder.settings_updated_successfully'));

                  return redirect()->back();
         }
}
