@push('scripts')
<script src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('content', {
        // Define changes to default configuration here.
        // For complete reference see:
        // http://docs.ckeditor.com/#!/api/CKEDITOR.config

        // The toolbar groups arrangement, optimized for two toolbar rows.
        ctoolbarGroups: [
            // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            // { name: 'links' },
            // { name: 'insert' },
            // { name: 'forms' },
            {name: 'tools'},
            // { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },

            // '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            // { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            {name: 'styles'},
            {name: 'others'}
            // { name: 'colors' },
            // { name: 'about' }
        ],

        // Remove some buttons provided by the standard plugins, which are
        // not needed in the Standard(s) toolbar.
        removeButtons: 'Underline,Subscript,Superscript',
        extraPlugins: 'markdown'  // this is the point!
    });
</script>
@endpush