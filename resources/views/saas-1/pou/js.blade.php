<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('saas/src/plugins/src/global/vendors.min.js')}}"></script>
    <script src="{{asset('saas/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{asset('saas/layouts/vertical-light-menu/app.js')}}"></script>
    <script src="{{asset('saas/src/assets/js/custom.js')}}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
 

   <!--  BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('saas/src/plugins/src/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/table/datatable/button-ext/jszip.min.js')}}"></script>    
    <script src="{{asset('saas/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/table/datatable/custom_miscellaneous.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->    
    
    <script src="{{asset('saas/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('saas/src/assets/js/apps/mailbox.js')}}"></script>
     <!-- BEGIN PAGE LEVEL SCRIPTS -->

     <script src="{{asset('saas/src/plugins/src/editors/markdown/simplemde.min.js')}}"></script>
     <script src="{{asset('saas/src/plugins/src/editors/markdown/custom-markdown.js')}}"></script>
     <script src="{{asset('saas/src/plugins/src/editors/quill/quill.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/editors/quill/custom-quill.js')}}"></script>
     <!-- END PAGE LEVEL SCRIPTS -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('saas/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('saas/src/assets/js/dashboard/dash_1.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('saas/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/sweetalerts2/custom-sweetalert.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/font-icons/feather/feather.min.js')}}"></script>
    
    <script src="{{asset('saas/src/plugins/src/vanillaSelectBox/vanillaSelectBox.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/vanillaSelectBox/custom-vanillaSelectBox.js')}}"></script>
    
    
    <script>
        feather.replace();
    </script>
    <script type="text/javascript">
    feather.replace();
    </script>
    <script>
    selectBox = new vanillaSelectBox("#selectok", {
    "keepInlineStyles":true,
    "maxHeight": 200,
    "minHeight":40,
    "minWidth":300,
    "search": true,
    "placeHolder": "Choose..." 
	});
   </script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('saas/src/plugins/src/filepond/filepond.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginImagePreview.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginImageCrop.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginImageResize.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/FilePondPluginImageTransform.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
    <script src="{{asset('saas/src/plugins/src/filepond/custom-filepond.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        multifiles.addFiles('{{asset("saas/src/assets/img/list-blog-style-2.jpeg")}}');
    </script>
     <script src="{{ asset('saas/src/plugins/dropify.min.js') }}"></script> 
<script>
            $(document).ready(function(){
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });
        </script>