define(['knockout', 'services/loginService', 'durandal/system'], function(ko, loginService, system){

    var loginViewModel = function(){
        var that = this;

        that.username = ko.observable('');
        that.password = ko.observable('');

        that.isRemember = ko.observable(false);


        that.loginError = ko.observable(false);
        that.errorMsg = ko.observable('');

        that.isSubmit = ko.computed(function(){
            if(that.username() != '' && that.password() != ''){
                return true;
            }
            return false;
        })
        that.isReset = function(){
            that.username('');
            that.password('');
            that.errorMsg('');
        }

        that.submit = function(){
            var data = {
                username: that.username(),
                password: that.password(),
                rememberMe: that.isRemember()
            }

            loginService.verify(data).then(function(response){
                if(response === true){
                    $.get('http://localhost/SpaApp/yii2/web/index.php?r=spa/users/index').then(function(response){
                       system.log(response)
                    })
                }
                else {
                    system.log(response);
                    that.errorMsg(response.msg);
                }
            });

        }

    }

    return new loginViewModel();
})
