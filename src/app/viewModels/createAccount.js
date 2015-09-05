define(['knockout', 'services/registerService', 'appConfig', 'durandal/app'], function(ko, registerService, appConfig, app) {
    var registerViewModel = function(){
        var that = this;

        that.errMsg = ko.observable('');
        that.showErrMsg = ko.observable(false);

        that.sex = ko.observable([1]);
        that.type_name = ko.observable('1');

        that.username = ko.observable('');
        that.email = ko.observable('');
        that.password = ko.observable('');
        that.repassword = ko.observable('');
        that.gender = ko.observableArray([
            {id: 1, genderValue: 'Male' },
            {id: 2, genderValue: 'Female' }
        ]);
        that.customerTypes = ko.observableArray([]);
        that.canRegister = ko.computed(function(){
            if(that.username() != '' && that.email() != '' && that.password() != '' && that.repassword() != ''){
                if(that.password() == that.repassword()){
                    that.showErrMsg(false);
                    that.errMsg('');
                    return true;
                }
                else {

                    that.showErrMsg(true);
                    that.errMsg('TThe two passwords don\'t match');
                    return false;
                }
            }
            return false;
        });

        that.verifyFields = function(){
            console.log('inplement some day.');
        }

        that.customerTypes = ko.observableArray([]);

        that.register = function(){
            var postJsData = ko.toJS(this);
            var postData = {};
            postData.username = postJsData.username;
            postData.email = postJsData.email;
            postData.password = postJsData.password;
            postData.sex = postJsData.sex[0];
            postData.type_id = postJsData.type_name[0];

            registerService.register(postData).then(function(response){
                    console.log(response);
                if(response.code == 0){
                    console.log(response);
                } else {

                }
            });
        }

        that.activate = function(){
            registerService.getTypes().then(function(response){
                that.customerTypes(response.data);
            });
        }

    }

    return new registerViewModel();

});
