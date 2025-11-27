@can('manage_staff')
        <div class="row">
            <div class="col-xl-6">
                <div class="mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label fw-bolder fs-3 mb-1">{{ __('messages.dashboard_show.recent_user') }}</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="pt-0">
                        <!--begin::Table container-->
                        <div class="">
                            <!--begin::Table-->
                            <table class="table table-striped">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th>{{ __('messages.dashboard_show.name') }}</th>
                                        <th>{{ __('messages.dashboard_show.email') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-5">
                                                        <img src="{{ $user->profile_image }}" alt="" width="50"
                                                            height="50" class="rounded-circle object-cover">
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span
                                                            class="text-muted fw-bolder text-muted d-block fs-7">{{ $user->first_name }}
                                                        </span>
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $user->first_name }}
                                                            {{ $user->last_name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-muted fw-bold text-muted d-block fs-7">{{ $user->email }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
    @endcan
