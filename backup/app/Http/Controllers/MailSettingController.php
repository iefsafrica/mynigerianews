<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMailSettingRequest;
use App\Mail\TestMail;
use App\Models\MailSetting;
use App\Repositories\MailSettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class MailSettingController extends Controller
{
    /**
     * @var MailSettingRepository
     */
    private $MailSettingRepository;

    /**
     * CategoryRepository constructor.
     */
    public function __construct(MailSettingRepository $MailSettingRepository)
    {
        $this->MailSettingRepository = $MailSettingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory
     */
    public function index(): View
    {
        $mailsetting = MailSetting::first();

        return view('mail_setting.index', compact('mailsetting'));
    }

    public function update(UpdateMailSettingRequest $request): RedirectResponse
    {
        $id = Auth::id();

        $this->MailSettingRepository->update($request->all(), $id);

        Flash::success(__('messages.placeholder.mail_updated_successfully'));

        return Redirect::back();
    }

    public function mail(Request $request): RedirectResponse
    {
        $id = Auth::id();

        $this->MailSettingRepository->update($request->all(), $id);

        Flash::success(__('messages.placeholder.mail_updated_successfully'));

        return Redirect::back();
    }

    public function contactMessage(Request $request): RedirectResponse
    {

        $request->validate([
            'contact_mail' => 'nullable|email:filter',
        ]);

        $id = Auth::id();

        $this->MailSettingRepository->update($request->all(), $id);

        Flash::success(__('messages.placeholder.mail_updated_successfully'));

        return Redirect::back();
    }

    public function sendTestemail(Request $request): RedirectResponse
    {

        $request->validate([
            'test_mails' => 'required|email:filter',
        ]);

        $id = Auth::id();
        Mail::to($request['test_mails'])
            ->send(new TestMail($request['test_mails'], $id));
        //        $this->MailSettingRepository->update($request->all(), $id);

        Flash::success(__('messages.placeholder.test_mail_send_successfully'));

        return Redirect::back();
    }
}
