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
/**
 *message hide
 *
 */
$("#loginMessage").show().delay(5000).fadeOut('slow');
