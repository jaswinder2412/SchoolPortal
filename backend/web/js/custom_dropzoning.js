var DropzoneError = 0;
var cid = 0;
var count = type = agree = disagree = neutral = somewhatagree = somewhatdisagree = 0;
var count1 = 0;
$(document).ready(function () {






    /* $('body').on('change', '#select_order', function() {
     var order = $(this).val();
     var category_id = $('.category_id').val();
     $.ajax({
     method: 'post',
     url: 'dailyinspiration',
     data: {ordernum: order,
     category_id: category_id
     },
     success: function(res) {
     $('#order_error').html(res);
     }
     });
     }); */


		var pkl = 0;
		var storeDate = [];
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#my-awesome-dropzone");
        $("#my-awesome-dropzone").addClass('dropzone');
        $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
        myDropzone.on("processing", function () {
            $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
            $('.modal-body .processtext').css('color', '#ff0000');
            $('.modal-body .processtext').text("Image Upload in Progress");
        });
		myDropzone.on('accept', function(file, done) {
				var thumbnail = $('.dropzone .dz-preview.dz-file-preview .dz-image:last');

				switch (file.type) {
				  case 'application/pdf':
					thumbnail.css('background', 'url(img/pdf.png');
					break;
				  case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
					thumbnail.css('background', 'url(img/doc.png');
					break;
				}

				done();
			  });
        myDropzone.on("success", function (file, response) {
			
            var parsed = JSON.parse(response);
			var str = parsed.toString();
			 storeDate[pkl] = str;
			  // save the item
			  sessionStorage.setItem('storeDate', JSON.stringify(storeDate));
			  console.log(storeDate);
			  pkl++
            if (parsed.Error != '' && parsed.Error != undefined) {
                DropzoneError++;
                return this.emit("error", file, parsed.Error);
            } else
            {
                count1++;
                $(file['previewTemplate']).find('.dz-image img').attr('rel', parsed.filename);
			
            }
            $(file['previewTemplate']).find('.dz-image').append('<div class=cross><img class="check1" src="http://injoyglobal.com/pilot/backend/web/img/uploads/tick.png" alt="error" width=38px/><img class="error" src="/dist/img/close.png" alt="error" width=38px/></div>');
			 
			 
       /*      $(file['previewTemplate']).find('.dz-image .cross .error').click(function () {
                var _this = $(this);
                var cid = $(this).parents('.dz-preview').find('.dz-image img').attr('alt');
                var url = 'folderdelete?filename=' + cid;
                $.ajax({
                    type: 'post',
                    url: url,
                    success: function (data) {
                        if (data)
                        {
                            count1--;
                            _this.parents('.modal-body').find('.responsetext').css('display', 'block');
                            _this.parents('.modal-body').find('.responsetext').css('color', '#ff0000');
                            _this.parents('.modal-body').find('.responsetext').text("Image " + data + " is deleted");
                            _this.parents('.dz-preview').remove();
                            if (DropzoneError == 0 && count1 >= 1) {
                                $('.modal-footer #popup_submit.btn.btn-success').removeAttr('disabled');
                                $('.modal-body .deletetext').css('display', 'none');
                                $('.modal-body .successtext').css('display', 'none');
                            }

                            if (DropzoneError > 0)
                            {
                                $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                                $('.modal-body .deletetext').css('color', '#ff0000');
                                $('.modal-body .successtext').css('display', 'none');
                                $('.modal-body .deletetext').css('display', 'block');
                                $('.modal-body .deletetext').text("please delete error images before submit");
                            } else if (count1 == 0)
                            {
                                $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                                $('.modal-body .successtext').css('color', '#ff0000');
                                $('.modal-body .deletetext').css('display', 'none');
                                $('.modal-body .successtext').css('display', 'block');
                                $('.modal-body .successtext').text("please upload at least one image");
                            }
                        }
                    }

                });
            }); */
        });
       /*  myDropzone.on("queuecomplete", function (file) {
            $('.image_close').click(function () {
                $('#add_image').modal('hide');
            });
            $('.modal-body .processtext').css('display','none');
            if (DropzoneError == 0 && count1 >= 1)
            {
                $('.modal-footer #popup_submit.btn.btn-success').removeAttr('disabled');
                $('.modal-body .responsetext').css('display', 'none');
                $('.modal-body .deletetext').css('display', 'none');
                $('.modal-body .successtext').css('display', 'none');
            }

            if (DropzoneError > 0)
            {
                $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                $('.modal-body .deletetext').css('color', '#ff0000');
                $('.modal-body .successtext').css('display', 'none');
                $('.modal-body .deletetext').css('display', 'block');
                $('.modal-body .deletetext').text("please delete error images before submit");
            } else if (count1 == 0)
            {
                $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                $('.modal-body .deletetext').css('display', 'none');
                $('.modal-body .successtext').css('color', '#ff0000');
                $('.modal-body .successtext').text("please upload at least one image");
            }
        });
        myDropzone.on("error", function (file, message, xhr) {
            var filename = file.name;
            var ext = filename.split('.').pop();
            if (ext != 'jpg' && ext != 'png' && ext != 'pdf' && ext != 'txt' && ext != 'doc') {
                this.removeFile(file);
                alert("you can't upload file of this type");
            }
            $(file['previewTemplate']).find('.dz-image').append('<div class=cross><img class="error1" src="http://beta.brstdev.com/adminlte/frontend/web/dist/img/close.png" alt="error" width=38px/></div>');
            $(file['previewTemplate']).find('.dz-image .cross .error1').click(function () {
                $(this).parents('.dz-preview').remove();
                DropzoneError--;
                if (DropzoneError == 0 && count1 >= 1) {
                    $('.modal-footer #popup_submit.btn.btn-success').removeAttr('disabled');
                    $('.modal-body .deletetext').css('display', 'none');
                    $('.modal-body .successtext').css('display', 'none');
                }

                if (DropzoneError > 0)
                {
                    $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                    $('.modal-body .deletetext').css('color', '#ff0000');
                    $('.modal-body .successtext').css('display', 'none');
                    $('.modal-body .deletetext').css('display', 'block');
                    $('.modal-body .deletetext').text("please delete error images before submit");
                } else if (count1 == 0)
                {
                    $('.modal-footer #popup_submit.btn.btn-success').attr('disabled', 'disabled');
                    $('.modal-body .successtext').css('color', '#ff0000');
                    $('.modal-body .deletetext').css('display', 'none');
                    $('.modal-body .successtext').css('display', 'block');
                    $('.modal-body .successtext').text("please upload at least one image");
                }

            });
        });


    // submit popup of add image // submit hit to save popup information
    $('body').on('click', '#popup_submit', function (e) {
	  
        $.ajax({
            method: 'post',
            url: 'gallerysubmit', 
            data: {
                imagess: storeDate
            },
            success: function (res) {
                location.reload();
            }
        });
        e.preventDefault(); 
    });

        $(".box-item img").draggable({
            appendTo: "body",
            helper: "clone",
            cursor: "move",
            revert: "invalid"
        });

        initDroppable($(".box-item img"));

   
 
  //image delete using ajax
    $('.box-item .delete1').css('cursor', 'pointer');
    $('.box-item .delete1').click(function () {
        var id = $(this).attr("rel");
        var url = 'gallery_image_delete?id=' + id;
        if (confirm('Are you sure you want to delete this item?'))
        {
            $.ajax({
                type: 'post',
                url: url,
                success: function (data)
                {
                    if (data == 'deleted')
                    {
                        $('.del' + id).remove();
                        var $grid = $('.grid-item').packery({
                            itemSelector: '.box-item',
                        });
                    }
                }
            });
        }
    });  */

/* 	var $grid = $('.grid-item').packery({
  itemSelector: '.box-item',
  columnWidth: 100
});

// make all grid-items draggable
$grid.find('.box-item').each( function( i, gridItem ) {
  var draggie = new Draggabilly( gridItem );
  // bind drag events to Packery
  $grid.packery( 'bindDraggabillyEvents', draggie );
}); */

// initialize Packery
/* var $grid = $('.grid-item').packery({
  itemSelector: '.box-item',
  // columnWidth helps with drop positioning
  columnWidth: 100
});

// make all items draggable
var $items = $grid.find('.box-item').draggable();
// bind drag events to Packery
$grid.packery( 'bindUIDraggableEvents', $items ); */


	 });  
