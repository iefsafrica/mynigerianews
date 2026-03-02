/**
 * MAANNEWS Login
 * ------------------
 * You should not use this file in production.
 *
 */
"use strict";
function copy(email, password)
{
    document.getElementById("email").value = email;
    document.getElementById("password").value = password;
}

$(document).on("click", ".quick-login-btn", function (e) {
    e.preventDefault();
    copy($(this).data("email"), $(this).data("password"));
});
/**
 *message hide
 *
 */
$("#loginMessage").show().delay(5000).fadeOut('slow');
