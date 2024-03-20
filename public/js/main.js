require.config({
    urlArgs: "v=" + (typeof cache_jscss_version === 'undefined' ? 0 : cache_jscss_version),
    baseUrl: SITE_ROOT,
    paths: {
        jquery: 'public/libs/jquery/jquery-3.6.min',
        'jquery-ui': 'public/libs/jquery-ui-1.12.1/jquery-ui',
        'jquery.ui.datepicker-vi': 'public/js/jquery/jquery.ui.datepicker-vi',
        bootstrap: 'public/libs/bootstrap-3.3.7-dist/js/bootstrap.min',
        'bootstrap-select': 'public/js/plugins/bootstrap-select/js/bootstrap-select.min',
        'iframe-transport': 'public/portal/js/jquery-iframe-transport/jquery.iframe-transport',
        dataTables: 'public/libs/DataTables-1.10.13/js/jquery.dataTables.min',
        'dataTables.bootstrap': 'public/libs/DataTables-1.10.13/js/dataTables.bootstrap',
        'dataTablesSort': 'public/js/plugins/datatables/dataTable'
    },
    shim: {
        jstree: ['jquery'],
        bootstrap: ['jquery'],
        'bootstrap-select': ['bootstrap'],
        dataTables: ['jquery'],
        'dataTables.bootstrap': ['dataTables']
    }
});