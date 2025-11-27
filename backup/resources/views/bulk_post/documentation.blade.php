<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="categoriesExampleModalLabel">{{ __('messages.bulk_post.documentation') }}</h3>
        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <table class="table">
            <tr>
                <th>{{__('messages.bulk_post.field')}}</th>
                <th>{{__('messages.post.description')}}</th>
            </tr>
            <tr>
                <td>{{ __('messages.menu.title')}}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.string')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: {{ __('messages.bulk_post.test_title') }}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.post.description') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.longText')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: {{ __('messages.bulk_post.test_description_about_this_post') }}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.post.keywords') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.string')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: {{ __('messages.bulk_post.examination') }}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.post.image') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.string')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <strong>{{__('messages.bulk_post.the_images_must_be_a_file_of_type_article_post')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: https://infynews.nyc3.digitaloceanspaces.com/post%20image/608/oxford-1.jpg</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.bulk_post.langid') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.integer')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: 1 </span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.bulk_post.categoryid') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.integer')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: 1 </span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.bulk_post.subcategoryid') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.integer')}}
                    <br>
                    <strong>{{ __('messages.bulk_post.Optional') }}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: 1 </span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.common.tags') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}: {{__('messages.bulk_post.string')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>{{__('messages.bulk_post.example')}}: {{ __('messages.bulk_post.advantages_power') }}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('messages.post.visibility') }}</td>
                <td>
                    {{__('messages.bulk_post.data_type')}}:  {{__('messages.bulk_post.boolean')}}
                    <br>
                    <strong>{{__('messages.required')}}</strong>
                    <br>
                    <span>1 {{__('messages.bulk_post.or')}} 0</span>
                </td>
            </tr>
        </table>
    </div>
</div>
