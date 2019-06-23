<?php

use Terminal42\PasswordValidationBundle\Model\PasswordHistory;

$GLOBALS['TL_HOOKS']['addCustomRegexp'][]   =
    ['terminal42_password_validation.listener.regexp', 'onAddCustomRegexp'];
$GLOBALS['TL_HOOKS']['setNewPassword'][]    =
    ['terminal42_password_validation.listener.history_log', 'onSetNewPassword'];
$GLOBALS['TL_HOOKS']['setNewPassword'][]    =
    ['terminal42_password_validation.listener.force_password_change_frontend', 'onSetNewPassword'];
$GLOBALS['TL_HOOKS']['checkCredentials'][]  =
    ['terminal42_password_validation.listener.invalid_attempts', 'onCheckCredentials'];
$GLOBALS['TL_HOOKS']['postLogin'][]         =
    ['terminal42_password_validation.listener.invalid_attempts', 'onPostLogin'];
$GLOBALS['TL_HOOKS']['postLogin'][]         =
    ['terminal42_password_validation.listener.password_change', 'onPostLogin'];
$GLOBALS['TL_HOOKS']['getSystemMessages'][] =
    ['terminal42_password_validation.listener.no_password_change_page_warning', 'onGetSystemMessages'];

$GLOBALS['TL_MODELS']['tl_password_history'] = PasswordHistory::class;

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'] = array_merge(
    (array) $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'],
    [
        'password_validation' => [
            'account_disabled' => [
                'recipients'           => [
                    'admin_email',
                    'user_email',
                ],
                'email_text'           => [
                    'username',
                    'user_*',
                ],
                'email_html'           => [
                    'username',
                    'user_*',
                ],
                'email_sender_name'    => [
                    'admin_email',
                ],
                'email_sender_address' => [
                    'admin_email',
                ],
                'email_recipient_cc'   => [
                    'admin_email',
                ],
                'email_recipient_bcc'  => [
                    'admin_email',
                ],
                'email_replyTo'        => [
                    'admin_email',
                ],
            ],
        ],
    ]
);