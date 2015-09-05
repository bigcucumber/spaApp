define(['durandal/app', 'durandal/system', 'durandal/viewLocator', 'plugins/router', 'durandal/binder', 'appConfig', 'i18next', 'jquery'], function(app, system, viewLocator, router, binder, appConfig, i18next, $){


    system.debug(appConfig.debug);
    app.title = appConfig.title;

    var i18nextOptions = {
        lng: 'en_US',
        ns: 'resource',
        resGetPath: 'src/app/resource/locales/__lng__/__ns__.json',
        useCookie: true,
        cookieName: 'lang',
        fallbackLng: 'en_US',
    }

    i18nextOptions.debug = appConfig.debug;

    app.configurePlugins({
        router:true,
        dialog: true
    });


    $(document).on('mouseover', '.border-shadow', function(){
        $(this).addClass('border-shadow-hover');
    }).on('mouseout', '.border-shadow', function(){
        $(this).removeClass('border-shadow-hover');
    });

    app.start().then(function(){
        i18next.init(i18nextOptions, function(){
            binder.binding = function(obj, view){
                jQuery(view).i18n();
            };
            viewLocator.useConvention('viewModels', 'views');
            app.setRoot('viewModels/shell');
        });
    });
});


