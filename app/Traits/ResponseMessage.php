<?php

namespace App\Traits;


Trait ResponseMessage
{

    public $load_success =
        [
            'message' => "Loaded Successfully",
            'alert-type' => 'success'
        ];
    public $create_success_message = [
        'message' => 'Created Successfully',
        'alert-type' => 'success',
    ];
    public $create_fail_message = [
        'message' => 'Sorry !! Create Failed',
        'alert-type' => 'error',
    ];

    public $edit_fail_message = [
        'message' => 'Sorry !! Edit Failed',
        'alert-type' => 'error',
    ];

    public $not_found_message = [
        'message' => 'Sorry !! Not Found',
        'alert-type' => 'info',
    ];

    public $update_success_message = [
        'message' => 'Updated Successfully',
        'alert-type' => 'success',
    ];

    public $update_fail_message = [
        'message' => 'Sorry!! Update Failed',
        'alert-type' => 'error',
    ];
    public $delete_success_message =
        [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        ];

    public $delete_fail_message =
        [
            'message' => 'Sorry !! Delete Failed',
            'alert-type' => 'error'
        ];

}
