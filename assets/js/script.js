$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        margin:10,
        autoplay: true,
        smartSpeed: 700,
        loop: true,
        autoplayHoverPause: true,
    });

    // var path = <?php echo Hii?>;
    // alert(tinyMCE.documentBaseURL);
    tinymce.init({
        selector: 'textarea',
        skin: 'lightgray',


        content_css: ["http://"+window.location.hostname+'/mcq/assets/plugins/matheditor/html/css/math.css'],
        external_plugins: {
            'mathEditor': "http://"+window.location.hostname+'/mcq/assets/plugins/matheditor/plugin.js',
            'chemEditor': "http://"+window.location.hostname+'/mcq/assets/plugins/marvin/plugin.js',
        },
        plugins : 'mathEditor,chemEditor image code media',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | mathEditor | chemEditor | image code media',

        file_picker_callback: function(callback, value, meta) {
            // File type
            if (meta.filetype =="media" || meta.filetype =="image") {

                // Trigger click on file element
                jQuery("#fileupload").trigger("click");
                $("#fileupload").unbind('change');
                // File selection
                jQuery("#fileupload").on("change", function() {
                    var file = this.files[0];
                    var reader = new FileReader();

                    // FormData
                    var fd = new FormData();
                    var files = file;
                    fd.append("file",files);
                    fd.append('filetype',meta.filetype);

                    var filename = "";

                    // AJAX
                    jQuery.ajax({
                        url: "upload.php",
                        type: "post",
                        data: fd,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(response){
                            filename = response;
                        }
                    });

                    reader.onload = function(e) {
                        callback("upload/"+filename);
                    };
                    reader.readAsDataURL(file);
                });
            }

        }

    });

});


$(document).ready(function () {
    $('#branch').change(function () {
        var branch_id = $('#branch').val();
            $.ajax({
                url: "pages/test.php",
                type: "POST",
                data: {
                    branch_id: branch_id,
                    trigger: "division"
                },
                dataType: 'text',
                success: function (data) {
                    $("#division").html(data);
                },
            });

    });
});

$(document).ready(function () {
    $('#division').change(function () {
        var division_id = $('#division').val();
        var branch_id = $('#branch').val();
            $.ajax({
                url: "pages/test.php",
                type: "POST",
                data: {
                    branch_id: branch_id,
                    division_id: division_id,
                    trigger:"semester"
                },
                dataType: 'text',
                success: function (data) {
                    $("#semester").html(data);
                }
            });

    });
});

$(document).ready(function () {
    $('#semester').change(function () {
        var division_id = $('#division').val();
        var branch_id = $('#branch').val();
        $.ajax({
            url: "pages/test.php",
            type: "POST",
            data: {
                division_id: division_id,
                trigger:"batch"
            },
            dataType: 'text',
            success: function (data) {
                $("#batch").html(data);
            }
        });
    });
});

$(document).ready(function () {
    $('#semester').change(function () {
        var semester_id = $('#semester').val();
        $.ajax({
            url: "pages/test.php",
            type: "POST",
            data: {
                semester_id: semester_id,
                trigger:"Subject"
            },
            dataType: 'text',
            success: function (data) {
                $("#subject").html(data);
            }
        });
    });
});










