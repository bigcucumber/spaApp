define(['knockout'], function(ko){

    var loginViewModel = function(){
        var that = this;

        that.username = ko.observable('');
        that.password = ko.observable('');

        that.isRemember = ko.observable(false);

        that.isSubmit = ko.computed(function(){
            if(that.username() != '' && that.password() != ''){
                return true;
            }
            return false;
        })
        that.isReset = function(){
            that.username('');
            that.password('');
        }

        that.submit = function(){
            var viewData = ko.toJSON(that);
            console.log(viewData);
            var data = {
                username: that.username(),
                password: that.password(),
                isRemember: that.isRemember()
            }

            console.log(data);
        }

    }

    return new loginViewModel();
})
