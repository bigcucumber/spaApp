requirejs.config({
    baseUrl: 'src/app',
    paths: {
        'jquery': '../../bower_components/jquery/jquery',
        'text': '../../bower_components/requirejs-text/text',
        'i18next': '../../bower_components/i18next/i18next.amd.withJQuery',
        'durandal': '../../bower_components/durandal/js',
        'plugins': '../../bower_components/durandal/js/plugins',
        'transitions': '../../bower_components/durandal/js/transitions',
        'knockout': '../../bower_components/knockout.js/knockout',
    },
    shim:{
        bootstrap: {
            deps: 'jquery',
            exports: 'bootstrap'
        }
    }
});
