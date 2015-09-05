define(['plugins/http', 'appConfig'], function(http, appConfig){

    var loginVerify = function(){
        var that = this;
        this.verify = function(postData){
            return http.jsonp(appConfig.hostUrl + 'spa/users/login', postData).then(function(response){
                if(response.code == 0)
                    return true;
                return response;
            });
        }
    }
    return  new loginVerify();
});
