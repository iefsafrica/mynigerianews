<?php

namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class StripeController extends AppBaseController
{
    public function paymentFailed(Request $request): View
    {
        Flash::success(__('messages.placeholder.purchased_plan'));

        return view('sadmin.plans.payment.paymentSuccess');
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     *
     * @throws Exception
     */

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function handleFailedPayment(): RedirectResponse
    {

        $subscriptionPlanId = session('subscription_plan_id');

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->paymentFailed($subscriptionPlanId);

        Flash::error(__('messages.placeholder.unable_to_process_payment'));

        return redirect(route('subscription.index'));

    }
}
