@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')
<style>
.popover {
  top: auto;
  left: auto;
}
</style>
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
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Position</label>
							<input name="id" type="hidden" value="" class="form-control">
							<input name="position" type="text" value="" class="form-control">
							
						</div>
					</div>
					 
				</div>
				
				<div class="row">
					<div class="col-lg-3">
						<div class="mb-3">
							<label class="form-label">Job Type</label>
							<select name="type" type="text" value="" class="form-control form-control-select2 d-none" required>
								<option value="penuh_waktu">Penuh Waktu</option>
								<option value="purna_waktu">Purna Waktu</option>
								<option value="magang">Magang</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="mb-3">
							<label class="form-label">Experience</label>
							<select name="experience" type="text" value="" class="form-control form-control-select2 d-none" required>
								<option value="magang">Magang</option>
								<option value="tingkat_pemula">Tingkat Pemula</option>
								<option value="senior">Senior</option>
								<option value="eksekutif">Eksekutif</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="mb-3">
							<label class="form-label">Expired At</label>
							<input name="expired_at" type="date" value="" class="form-control">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3 mt-4">
							
							<textarea name="description" type="text" id="editor" rows="10" placeholder="Enter your content..." class="form-control"></textarea>
							
						</div>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-lg-4">
						<div class="mb-3">
							<label class="form-label">Status</label>
							<select name="status" type="text" value="" class="form-control form-control-select2 d-none" required>
								<option value="publish">Publish</option>
								<option value="unpublish">Unpublish</option>
							
							</select>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="mb-3 mt-4 text-center">
							<label for="img">
								<img class="img-thumbnail img" id="view" src="{{ asset('/assets/images/upload.png') }}"/>
								<input type="text"  name="userFile"  id="img" class="form-control d-none" >
							</label>
							
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div>
						
					</div>
					
				</div>

			 
				<div class="text-end mt-4">
					<button id="btn-action" type="submit" class="btn btn-indigo">Submit Career <i class="ph-paper-plane-tilt ms-2"></i></button>
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
<script src="{{ asset('assets/dashboard/js/vendor/forms/selects/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>	
<script src="{{ asset('assets/file-manager/js/stand-alone-button.js') }}"></script>	
  
<script>
	 
	$('.form-control-select2').select2({
	minimumResultsForSearch: Infinity
	});	
	let route_prefix = BaseUrl+"/filemanager";
	let typeForm = 'create';
	let path;
	
	<?php if(isset($data['career_id'])){ ?>
	let id = '{{ $data['career_id'] }}';
	<?php } ?>
	
	function loadCareers() {
        $.ajax({
            url: ServUrl+'/careers/detail',
            data: {'id' : id},
            type: 'GET',
            dataType: 'JSON',
			complete: (response) => {
				if(response.status == 200) {
				var careers = response.responseJSON.data.careers;
                   $('input[name=id]').val(careers.id);
                   $('input[name=position]').val(careers.position);
                   $('input[name=type]').val(careers.type);
                   $('input[name=experience]').val(careers.experience);
                   $('input[name=expired_at]').val(careers.expired_at);
                   $('input[name=status]').val(careers.status);
                   $('input[name=userFile]').val(careers.img);
				   $('#view').attr('src', careers.img);
				   
				   $('textarea[name=description]').summernote('pasteHTML', careers.description);
				   //$('textarea[name=description]').val(careers.description);
				   
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
		path = ServUrl+"/careers/update";
	}else{
		path = ServUrl+"/careers/create";
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
							location.href = BaseUrl+'/dashboard/careers/detail/'+response.responseJSON.data.id;
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
	
	
	$("#img").click(function(){
		lfmSecond('img', 'image', {prefix: route_prefix});
	});
	
	var lfmSecond = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(id);
        var target_preview  = document.getElementById('view');
       
        window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
          }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_preview.src = file_path;
          target_input.dispatchEvent(new Event('change'));


        };
      });
    };
	
	<?php if(isset($data['career_id'])){ ?>
	loadCareers();
	<?php } ?>
</script> 
	
@endsection

