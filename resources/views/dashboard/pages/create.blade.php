@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- Content area -->
<div class="content">

	<!-- Profile info -->
	<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">{{ $data['page_title'] }}</h5>
		</div>

		<div class="card-body">
			<form id="form-create" action="#">
				<div class="row">
					<div class="col-lg-8">
						<div class="mb-3">
							<label class="form-label">Page Title</label>
							<input name="id" type="hidden" value="" class="form-control">
							<input name="title" type="text" value="" class="form-control">
							<div class="form-text text-muted">make sure the title is unique</div>
						</div>
					</div>
					 
				</div>
				
				
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3 mt-4">
							
							<textarea name="content" type="text" id="editor" rows="10" placeholder="Enter your content..." class="form-control"></textarea>
							
						</div>
					</div>
					
				</div>
				
				<legend class="fs-base fw-bold border-bottom mt-4 mb-3">Meta information</legend>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">SEO Keyword</label>
							<textarea name="keyword" type="text" rows="3" placeholder="Enter your meta keyword..." class="form-control"></textarea>
							<div class="form-text text-muted">use the best keyword and sparate with comma (,) </div>
						</div>
					 
						<div class="mb-3">
							<label class="form-label">SEO Description</label>
							<textarea name="description" type="text" rows="3" placeholder="Enter your meta description..." class="form-control"></textarea>
							 
						</div>
						
					</div>
					
				</div>

			 
				<div class="text-end mt-4">
					<button id="btn-action" type="submit" class="btn btn-indigo">Submit Page <i class="ph-paper-plane-tilt ms-2"></i></button>
					<button id="btn-loading" type="button" class="btn btn-secondary btn-loading d-none">
						<span class="mx-4"><i class="ph-spinner spinner"></i></span>
					</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	<!-- /profile info -->

</div>
<!-- /content area -->
<!-- include summernote css/js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>	
	<script src="{{ asset('assets/file-manager/js/stand-alone-button.js') }}"></script>	
	
<script>
	 
	let route_prefix = BaseUrl+"/filemanager";
	let myEditor;
	let typeForm;
	let path;
	
	<?php if(isset($data['page_id'])){ ?>
	let id = '{{ $data['page_id'] }}';
	<?php } ?>
	
	function loadPages() {
        $.ajax({
            url: ServUrl+'/pages/detail',
            data: {'id' : id},
            type: 'GET',
            dataType: 'JSON',
			complete: (response) => {
				if(response.status == 200) {
				var pages = response.responseJSON.data.pages;
                   $('input[name=id]').val(pages.id);
                   $('input[name=title]').val(pages.title);
				   
				   $('textarea[name=keyword]').val(pages.keyword);
				   $('textarea[name=description]').val(pages.description);
				   $('textarea[name=caption]').val(pages.caption);
				   
				   $('textarea[name=content]').summernote('pasteHTML', pages.conten);
				   typeForm = 'update';
					
                }
                
            }
        })
    }
	
	
	var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : route_prefix;
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
      };

      // Define LFM summernote button
      var LFMButton = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'Insert image with filemanager',
          click: function() {

            lfm({type: 'image', prefix: route_prefix}, function(lfmItems, path) {
              lfmItems.forEach(function (lfmItem) {
                context.invoke('insertImage', lfmItem.url);
              });
            });

          }
        });
        return button.render();
      };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('#editor').summernote({
		height: 500,
		fontNames: [ 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento'],
		fontNamesIgnoreCheck: [ 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento'],
		fontSizes: ['8', '9', '10', '11', '12', '14', '15', '16', '18', '24', '36', '48' , '64', '82', '150'],

        toolbar: [
		  ['style', ['style', 'fontname', 'bold', 'italic', 'underline', 'clear']],
		  ['font', ['strikethrough', 'superscript', 'subscript']],
		  ['insert', ['link','table']],
          ['popovers', ['lfm']],
		  ['view', ['fullscreen', 'codeview', 'help']],
        ],
        buttons: {
          lfm: LFMButton
        }
      });
	
	$("#form-create").submit(function(event) {
	event.preventDefault();
	
	$('#btn-action').addClass('d-none');
	$('#btn-loading').removeClass('d-none');
	if(typeForm == 'update'){
		path = ServUrl+"/pages/update";
	}else{
		path = ServUrl+"/pages/create";
	} 
	var form = $("#form-create")[0]; 
	var data = new FormData(form);
	
	swalInit.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, '+typeForm+' it!',
		cancelButtonText: 'No, cancel!',
		buttonsStyling: false,
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		}
	}).then(function(result) {
		if(result.value) {
			
				$.ajax({
					data: data,
					url: path,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					method: 'POST',
					complete: function(response){                
					if(response.status == 201){
						swalInit.fire({
								title: typeForm+'!',
								text: response.responseJSON.message,
								icon:'success'
							}); 
						$('#btn-action').removeClass('d-none');
						$('#btn-loading').addClass('d-none'); 
						setTimeout(function(){
							location.href = BaseUrl+'/dashboard/pages/detail/'+response.responseJSON.data.id;
						}, 800);
					}else{
						swalInit.fire({
								title: 'Aborted!',
								text: response.responseJSON.message,
								icon:'warning'
							});	
						$('#btn-action').removeClass('d-none');
						$('#btn-loading').addClass('d-none');
						//location.reload(); 
					}
					},
					dataType:'json'
			});
			
			
		}
		else if(result.dismiss === swal.DismissReason.cancel) {
			$('#btn-action').removeClass('d-none');
			$('#btn-loading').addClass('d-none');
		}
	});
			
	});
	
	
	
	<?php if(isset($data['page_id'])){ ?>
	loadPages();
	<?php } ?>
</script> 
	
@endsection

