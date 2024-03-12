jQuery(document).ready(function($){
  var mediaUploader;
  var attachmenturl;
  
  $(document).on('click', '.upload_image_button', function(e) {
	  
	   var mediaUploader = undefined;
	  var hts= undefined; 
	  var hts= $(this);
    e.preventDefault();
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
	
      $('.background_imageid').val(attachment.id);
      $(hts).siblings('.background_imageurl').val(attachment.url);
      
	  attachmenturl = attachment.url;
	  
	  $(hts).siblings(".imgdivcolr").children('img').attr('src', attachmenturl);
	  mediaUploader.close();
	   
    });
    
	 
   /*  */
  mediaUploader.open();
  });
  
  
  
});