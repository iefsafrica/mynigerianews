<div id="addMailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.mails.mail_content') }}</h3>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['files' => true, 'id'=>'addMail','class'=>'form']) }}

            <div class="modal-body">
                <input type="hidden" id="AllMailToSend" name="mail">
                {{ Form::label('mail_subject', __('messages.mails.mail_subject').':', ['class' => 'form-label required mb-3']) }}
                {{ Form::text('mail_subject', null, ['class' => 'form-control mb-5 mail_subject','required','placeholder' => __('messages.mails.mail_subject'),
   'id' => 'mailSubject']) }}
                <div class="alert alert-danger display-none hide d-none" id="languageValidationErrorsBox"></div>
                {{ Form::label('terms&conditions',__('messages.mails.mail_content').':',
           ['class'=>'form-label required fw-bold fs-6']) }}
                <div class="col-lg-12 fv-row">
                                 <textarea id="sendMail" name="send_mail"
                                           class="tox-target">
                                 </textarea>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary m-0']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 me-0 discard-mail'.(auth()->user()->language == 'ar' ? ' me-5' : ' ms-5'),'data-bs-dismiss'=>'modal']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
