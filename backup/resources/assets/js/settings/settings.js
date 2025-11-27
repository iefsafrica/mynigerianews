'use strict';
document.addEventListener('turbo:load', settingsData)
function settingsData(){
    $('#selectLanguage').select2({
        language: {
            noResults: function (params) {
                return Lang.get('js.no_results_found');
            }
        },
        width: '100%',
    })
    $('#selectRssFeed').select2({
        language: {
            noResults: function (params) {
                return Lang.get('js.no_results_found');
            }
        },
        width: '100%',
    })
    let SocialMediaIsEdit = $('#socialMediaIsEdit').val()


    // tinymce.init({
    //     mode: 'specific_textareas',
    //     editor_selector: 'setting-text-description',  // change this value according to your HTML
    //     plugin: 'a_tinymce_plugin',
    //     a_plugin_option: true,
    //     a_configuration_option: 400,
    //     relative_urls: false,
    //     remove_script_host: false,
    //     convert_urls: true,
    //     document_base_url: "{{ config('app.url') }}",
    //     height: 400,
    //     content_style: tinymce_textarea_coler,
    // })
    // tinymce.init({
    //     selector: '.text-gallery-description,.text-sort_list-description',
    //     themes: 'modern',
    //     height: 200,
    //     content_style: tinymce_textarea_coler,
    // })

    if ($('#addTermsConditionsQuillData').length) {
        window.addTermsConditionsQuill = new Quill(
            '#addTermsConditionsQuillData', {
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    keyboard: {
                        bindings: {
                            tab: 'disabled',
                        }
                    }
                },
                theme: 'snow',
            });
        addTermsConditionsQuill.root.innerHTML = $('#termsConditions').val();
    }

    if ($('#addSupportQuillData').length) {
        window.addSupportQuill = new Quill(
            '#addSupportQuillData', {
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    keyboard: {
                        bindings: {
                            tab: 'disabled',
                        }
                    }
                },
                theme: 'snow',
            });
        addSupportQuill.root.innerHTML = $('#support').val();
    }

    if($('#addPrivacyQuillData').length) {
        window.addPrivacyQuill = new Quill(
            '#addPrivacyQuillData', {
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    keyboard: {
                        bindings: {
                            tab: 'disabled',
                        }
                    }
                },
                theme: 'snow',
            });
        addPrivacyQuill.root.innerHTML = $('#privacy').val();
    }

    if($('#addManualPaymentGuideQuillData').length) {
        window.addManualPaymentGuideQuill = new Quill(
            '#addManualPaymentGuideQuillData', {
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    keyboard: {
                        bindings: {
                            tab: 'disabled',
                        }
                    }
                },
                theme: 'snow',
            });
        addManualPaymentGuideQuill.root.innerHTML = $('#manualPaymentGuide').val();
    }
};

listen('submit', '#socialMediaForm', function (e) {
    // e.preventDefault();

    $('#socialMediaForm').find('input:text:visible:first').focus();
    let facebookUrl = $('#facebookUrl').val();
    let twitterUrl = $('#twitterUrl').val();
    let pinterestUrl = $('#pinterestUrl').val();
    let linkedInUrl = $('#linkedInUrl').val();
    let instagramUrl = $('#instagramUrl').val();
    let vkUrl = $('#vkUrl').val();
    let telegramUrl = $('#telegramUrl').val();
    let youtubeUrl = $('#youtubeUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);
    let pinterestExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)pinterest\.[a-z]{2,3}\/?.*/i);
    let instagramExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)instagram\.[a-z]{2,3}\/?.*/i);
    let vkExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)vk\.[a-z]{2,3}\/?.*/i);
    let telegramExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)telegram\.[a-z]{2,3}\/?.*/i);
    let youtubeExp = new RegExp(
        /^(https?:\/\/)?((w{3}\.)?)youtube\.[a-z]{2,3}\/?.*/i);

    urlValidation(facebookUrl, facebookExp);
    urlValidation(twitterUrl, twitterExp);
    urlValidation(pinterestUrl, pinterestExp);
    urlValidation(linkedInUrl, linkedInExp);
    urlValidation(instagramUrl, instagramExp);
    urlValidation(vkUrl, vkExp);
    urlValidation(telegramUrl, telegramExp);
    urlValidation(youtubeUrl, youtubeExp);

    if (!urlValidation(facebookUrl, facebookExp)) {
        displayErrorMessage(Lang.get('js.invalid_facebook_url'));
        return false;
    }
    if (!urlValidation(twitterUrl, twitterExp)) {
        displayErrorMessage(Lang.get('js.invalid_twitter_url'));
        return false;
    }
    if (!urlValidation(linkedInUrl, linkedInExp)) {
        displayErrorMessage(Lang.get('js.invalid_linkedin_url'));
        return false;
    }
    if (!urlValidation(pinterestUrl, pinterestExp)) {
        displayErrorMessage(Lang.get('js.invalid_pinterest_url'));
        return false;
    }
    if (!urlValidation(instagramUrl, instagramExp)) {
        displayErrorMessage(Lang.get('js.invalid_instagram_url'));
        return false;
    }
    if (!urlValidation(vkUrl, vkExp)) {
        displayErrorMessage(Lang.get('js.invalid_vk_url'));
        return false;
    }
    if (!urlValidation(telegramUrl, telegramExp)) {
        displayErrorMessage(Lang.get('js.invalid_telegram_url'));
        return false;
    }
    if (!urlValidation(youtubeUrl, youtubeExp)) {
        displayErrorMessage(Lang.get('js.invalid_youtube_url'));
        return false;
    }
    // $('#socialMediaForm')[0].submit();

    // return true;
});

listen('submit', '#cmsForm', function (e) {
    // e.preventDefault();

    let tc_content = addTermsConditionsQuill.root.innerHTML;
    let input = JSON.stringify(tc_content);
    $('#termsConditions').val(input.replace(/"/g, ''));

    let support_content = addSupportQuill.root.innerHTML;
    let input2 = JSON.stringify(support_content);
    $('#support').val(input2.replace(/"/g, ''));

    let privacy_content = addPrivacyQuill.root.innerHTML;
    let input3 = JSON.stringify(privacy_content);
    $('#privacy').val(input3.replace(/"/g, ''));

    let manualPaymentGuide_content = addManualPaymentGuideQuill.root.innerHTML
    let input4 = JSON.stringify(manualPaymentGuide_content)
    $('#manualPaymentGuide').val(input4.replace(/"/g, ''))

    let terms_string = $('#terms_condition').val()
    terms_string = terms_string.replace(/<[^>]*>?/gm, '');
    terms_string = terms_string.replace(/&nbsp;/gm, '');
    if (isEmpty(terms_string.trim())) {
        displayErrorMessage(Lang.get('js.required_t&c'));
        return false;
    }

    let support_string = $('#support').val()
    support_string = support_string.replace(/<[^>]*>?/gm, '');
    support_string = support_string.replace(/&nbsp;/gm, '');
    if (isEmpty(support_string.trim())) {
        displayErrorMessage(Lang.get('js.required_support'));
        return false
    }

    let privacy_string = $('#privacyPolicy').val()
    privacy_string = privacy_string.replace(/<[^>]*>?/gm, '')
    privacy_string = privacy_string.replace(/&nbsp;/gm, '')
    if (isEmpty(privacy_string.trim())) {
        displayErrorMessage(Lang.get('js.required_privacy'))
        return false
    }

    let manualPaymentGuide = $('#manualPaymentGuide').val()
    manualPaymentGuide = manualPaymentGuide.replace(/<[^>]*>?/gm, '')
    manualPaymentGuide = manualPaymentGuide.replace(/&nbsp;/gm, '')

    // $('#cmsForm')[0].submit();

    // return true;
});

listen('change', ['#showCaptcha', '#showCaptchaOnRegistration'], function () {
    if (($('#showCaptcha').prop('checked') || $('#showCaptchaOnRegistration').prop('checked'))) {
        $('.captchaOptions').removeClass('d-none');
    } else {
        $('.captchaOptions').addClass('d-none');
    }
})

listen('submit', '#contact-information-form', function (e) {
    let contact_address = $('#contact_address').val();
    let about_text = $('#about_text').val();
    if (contact_address.length > 500) {
        toastr.error(Lang.get('js.max', {attribute: 'Contact address', max: '500 characters'}));
        return false;
    } else if (about_text.length > 500) {
        toastr.error(Lang.get('js.max', {attribute: 'About text', max: '500 characters'}));
        return false;
    }
    // $('#contact-information-form')[0].submit();

})

function ManualPaymentGuide () {
    if (!$('#manualPaymentGuideId').length) {
        return
    }
    quill = new Quill('#manualPaymentGuideId', {

        modules: {
            toolbar: [
                [{ 'font': [] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ],
        },
        placeholder: Lang.get('js.manual_payment_guide'),
        theme: 'snow', // or 'bubble'
    })

    quill.on('text-change', function (delta, oldDelta, source) {

        if (quill.getText().trim().length === 0) {

            quill.setContents([{ insert: '' }])
        }
    })

    let element = document.createElement('textarea')
    element.innerHTML = $('#manualPaymentGuideData').val()
    quill.root.innerHTML = element.value

    listenSubmit('#ManualPaymentGuides', function () {

        let elements = document.createElement('textarea')
        let editor_content = quill.root.innerHTML

        elements.innerHTML = editor_content
        if (quill.getText().trim().length === 0) {
            editor_content = ''

        }

        $('#guideData').val(JSON.stringify(editor_content))
    })

}

listenClick( '.theme-img-radio ', function () {
    $('.theme-img-radio').removeClass('img-border')
    $(this).addClass('img-border')
   $('#themeInput').val($(this).attr('data-id'))

})

listenClick('#stripeCheckboxBtn', function () {
         if($(this).is(':checked')) {
                  $('.stripe-creds').removeClass('d-none');
         }else {
                  $('.stripe-creds').addClass('d-none');
         }
});
listenClick('#paypalCheckboxBtn', function () {
         if($(this).is(':checked')) {
                  $('.paypal-creds').removeClass('d-none');
         }else {
                  $('.paypal-creds').addClass('d-none');
         }
});
listenSubmit('#paymentForm', function (e) {
         e.preventDefault()
         let stripeCheckbox = $('#stripeCheckboxBtn').is(':checked')
         let paypalCheckbox = $('#paypalCheckboxBtn').is(':checked')
         let emptyStripeKey = $('#stripeKey').val().trim()
         let emptyStripeSecret = $('#stripeSecret').val().trim()

         if (stripeCheckbox) {
             if(isEmpty(emptyStripeKey)) {
                 displayErrorMessage(Lang.get('js.stripe_key'))
                 return false;
             }else if(isEmpty(emptyStripeSecret)) {
                 displayErrorMessage(Lang.get('js.stripe_secret'))
                 return false;
             }
         }

         let emptyPaypalId = $('#paypalKey').val().trim();
         let emptyPaypalSecret = $('#paypalSecret').val().trim();
         let emptyPaypalMode = $('#paypalMode').val().trim();

         if(paypalCheckbox){
             if(isEmpty(emptyPaypalId)) {
                 displayErrorMessage(Lang.get('js.paypal_client_id'))
                 return false;
             }else if(isEmpty(emptyPaypalSecret)) {
                 displayErrorMessage(Lang.get('js.paypal_secret'))
                 return false;
             }else if(isEmpty(emptyPaypalMode)) {
                 displayErrorMessage(Lang.get('js.paypal_mode'))
                 return false;
             }
         }

         $('#paymentMethodSave').attr('disabled',true)
             $('#paymentForm')[0].submit();
     });
