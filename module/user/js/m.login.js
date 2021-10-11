$(document).ready(function()
{
    $('#loginForm').submit(function()
    {
        var account          = $('#account').val().trim();
        var password         = $('#password').val().trim();
        var passwordStrength = computePasswordStrength(password);

        var hasMD5    = typeof(md5) == 'function';
        var rand      = $('input#verifyRand').val();
        var link      = createLink('user', 'login');
        var keepLogin = $('[name=keepLogin]').prop('checked') ? 1 : 0;
        $.ajax
        ({
            url: link,
            dataType: 'json',
            method: 'POST',
            data: 
            {
                "account": account, 
                "password": hasMD5 ? md5(md5(password) + rand) : password,
                'passwordStrength' : passwordStrength,
                'verifyRand' : rand,
                'keepLogin' : keepLogin,
            },
            success:function(data)
            {
                if(data.result == 'fail') 
                {
                    alert(data.message);
                    return false;
                }
                else
                {
                    location.href = data.locate;
                }
            }
        })

        return false;
    });
});
