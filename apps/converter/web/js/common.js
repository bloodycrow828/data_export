$(document).ready(function () {

    $('.save-type').on('click', function (event) {
        let $ftpCredentials = $('.ftp-credentials');

        let $ftpLogin = $('#ftp-login');
        let $ftpPassword = $('#ftp-password');

        if ($(this).val() === 'ftp') {
            $ftpCredentials.removeClass('invisible')
            $ftpLogin.addClass('required')
            $ftpPassword.addClass('required')
        } else {
            $ftpCredentials.addClass('invisible')
            $ftpLogin.removeClass('required')
            $ftpPassword.removeClass('required')
        }

        let $stepTwo = $('.step-two');
        $stepTwo.removeClass('invisible')

        console.log($(this).val())
    });

})