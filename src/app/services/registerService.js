/**
 * Created by luowen on 9/5/15.
 */
define(['plugins/http', 'appConfig'], function(http, appConfig){

    var registerService = function(){
        var that = this;
        that.getTypes = function(){
            return http.jsonp(appConfig.hostUrl + 'spa/customertype/index', function(response){
                return response;
            });
        };

        that.register = function(postData){
            console.log(postData);
            return http.jsonp(appConfig.hostUrl + 'spa/users/register', postData).then(function(response){
                return response;
            });
        }
    }
    return new registerService();
})
