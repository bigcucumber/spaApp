define(['plugins/router', 'durandal/app', 'durandal/system'], function (router, app, system) {
    return {
        router: router,
        search: function() {
            //It's really easy to show a message box.
            //You can add custom options too. Also, it returns a promise for the user's response.
            app.showMessage('Search not yet implemented...');
        },
        activate: function () {
            router.map([
                { route: '', title:'Welcome', moduleId: 'viewModels/index', nav: true },
            ]).mapUnknownRoutes('viewModels/common/notfound', 'not-found').buildNavigationModel();
            return router.activate();
        },
    };
});
