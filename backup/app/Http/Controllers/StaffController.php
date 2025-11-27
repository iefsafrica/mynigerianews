<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\MailSetting;
use App\Models\Role;
use App\Models\User;
use App\Repositories\StaffRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class StaffController extends AppBaseController
{
    /** @var StaffRepository */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
        $mailData = MailSetting::first();
        $protocol = MailSetting::TYPE[$mailData->mail_protocol];
        $host = $mailData->mail_host;

        if ($mailData->mail_protocol == MailSetting::MAIL_LOG) {
            $protocol = 'log';
            $host = 'mailhog';
        }

        if ($mailData->mail_protocol == MailSetting::SMTP) {
            $protocol = 'smtp';
        }

        if ($mailData->mail_protocol == MailSetting::SENDGRID) {
            $protocol = 'sendgrid';
        }

        config([
            'mail.default' => $protocol,
            "mail.mailers.$protocol.transport" => $protocol,
            "mail.mailers.$protocol.host" => $host,
            "mail.mailers.$protocol.port" => $mailData->mail_port,
            "mail.mailers.$protocol.encryption" => MailSetting::ENCRYPTION_TYPE[$mailData->encryption],
            "mail.mailers.$protocol.username" => $mailData->mail_username,
            "mail.mailers.$protocol.password" => $mailData->mail_password,
        ]
        );
    }

    /**
     * Display a listing of the Staff.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('staffs.index');
    }

    /**
     * Show the form for creating a new Staff.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $roles = Role::whereNotIn('name', ['customer'])->pluck('display_name', 'id');

        return view('staffs.create', compact('roles'));
    }

    /**
     * Store a newly created Staff in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreateStaffRequest $request): RedirectResponse
    {

        $input = $request->all();

        $this->staffRepository->store($input);

        Flash::success(__('messages.placeholder.staff_created_successfully'));

        return redirect(route('staff.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function show(User $staff): \Illuminate\View\View
    {
        $staff->load('roles');

        return view('staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified Staff.
     *
     * @return Application|Factory|View
     */
    public function edit(User $staff): \Illuminate\View\View
    {
        $staff->load('roles');
        $roles = Role::whereNotIn('name', ['customer'])->pluck('display_name', 'id');
        //        $roles = $this->staffRepository->getRole();

        return view('staffs.edit', compact('staff', 'roles'));
    }

    /**
     * Update the specified Staff in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateStaffRequest $request, User $staff): RedirectResponse
    {

        $request['status'] = isset($request['status']);
        $this->staffRepository->update($request->all(), $staff->id);

        Flash::success(__('messages.placeholder.staff_updated_successfully'));

        return redirect(route('staff.index'));
    }

    /**
     * Remove the specified Staff from storage.
     */
    public function destroy(User $staff): JsonResponse
    {
        $staff->delete();

        return $this->sendSuccess(__('messages.placeholder.staff_deleted_successfully'));
    }

    /**
     * Show the form for editing the specified Staff.
     *
     * @return Application|Factory|View
     */
    public function resendEmail(User $staff)
    {
        $this->staffRepository->resendEmail($staff->id);

        return $this->sendSuccess(__('messages.placeholder.email_send_successfully'));
    }
}
