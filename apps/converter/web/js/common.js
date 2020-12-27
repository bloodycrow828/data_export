$(document).ready(function () {

    $('.save-type').on('click', function () {
        let $ftpCredentials = $('.ftp-credentials')

        if ($(this).val() === 'ftp') {
            $ftpCredentials.removeClass('invisible')
        } else {
            $ftpCredentials.addClass('invisible')
        }

        let $stepTwo = $('.step-two');
        $stepTwo.removeClass('invisible')
    });

    let $ftpHost = $('#ftp-host');
    let $ftpPath = $('#ftp-path');
    let $ftpLogin = $('#ftp-login');
    let $ftpPassword = $('#ftp-password');

    let $ftpCredentialFormHost = $('#ftpcredentialform-host')
    let $ftpCredentialFormPath = $('#ftpcredentialform-path')
    let $ftpCredentialFormLogin = $('#ftpcredentialform-login')
    let $ftpCredentialFormPassword = $('#ftpcredentialform-password')

    $ftpHost.on('change', function () {
        $ftpCredentialFormHost.val($ftpHost.val())
    })
    $ftpPath.on('change', function () {
        $ftpCredentialFormPath.val($ftpPath.val())
    })
    $ftpLogin.on('change', function () {
        $ftpCredentialFormLogin.val($ftpLogin.val())
    })
    $ftpPassword.on('change', function () {
        $ftpCredentialFormPassword.val($ftpPassword.val())
    })

})