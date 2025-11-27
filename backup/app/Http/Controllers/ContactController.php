<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactUsRequest;
use App\Mail\MailService;
use App\Models\Contact;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends AppBaseController
{
    //front contact
    public function index(): View
    {
        if (getCurrentTheme() == 1) {
            return view('theme1.contact-us');
        }
        return view('front_new.contact-us');
    }

    public function store(CreateContactUsRequest $request)
    {
        if ((getSettingValue()['show_captcha'] == '1') && $request['g-recaptcha-response'] == null) {
            return $this->sendError(__('messages.placeholder.reCAPTCHA_required'));
        }
        $input = $request->all();

        $contact = Contact::create($input);

        $status = MailSetting::where('contact_messages', 1)->first();

        if (!empty($status)) {
            Mail::to($status->contact_mail)->send(new MailService($contact));
        }

        return $this->sendSuccess('success');
    }

    //backend contact
    public function listContact(): View
    {
        return view('contact.index');
    }

    public function removeContact($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact) {
            $contact->delete();
        }

        return $this->sendSuccess(__('messages.placeholder.contact_deleted_successfully'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return $this->sendResponse($contact, __('messages.placeholder.language_saved_successfully'));
    }
}
