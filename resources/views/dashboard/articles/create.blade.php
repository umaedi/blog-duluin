@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.note-editor{font-family:Arial}
</style>
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
							<label class="form-label">Title</label>
							<input name="id" type="hidden" value="" class="form-control">
							<input name="title" type="text" value="" class="form-control">
							<div class="form-text text-muted">make sure the title for article is unique</div>
						</div>
					</div>
					 
				</div>
				<div class="row">
					<div class="col-lg-3">
						<div class="mb-3">
							<label class="form-label">Category</label>
							<select name="category_id" type="text" value="" class="form-control form-control-select2 d-none" required>
							
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="mb-3">
							<label class="form-label">Tags</label>
							<input name="tags" type="hidden" value=""/> 
							<select name="tag" type="text" class="form-control multiselect d-none" multiple="multiple" data-include-select-all-option="true"></select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="mb-3">
							<label class="form-label">Date</label>
							<input name="date" type="date" value="" class="form-control">
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
							<label class="form-label">Headlines ?</label>
							<div>
								<label class="form-check form-check-inline">
									<input type="radio" value="1" class="form-check-input" name="headline" required>
									<span class="form-check-label">Yes</span>
								</label>

								<label class="form-check form-check-inline">
									<input type="radio" value="0" class="form-check-input" name="headline" checked required>
									<span class="form-check-label">No</span>
								</label>
							</div>
						</div>
					</div>
					 
				</div>
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
						
						<div class="mb-3">
							<label class="form-label">Caption Cover</label>
							<textarea name="caption" type="text" rows="3" placeholder="Enter your caption cover..." class="form-control"></textarea>
							 
						</div>
					</div>
					<div class="col-lg-6">
					<label class="form-label">Choose Cover</label>
					<ul class="nav nav-pills nav-pills-outline nav-fill" id="myTab" role="tablist">
					  <li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Images</button>
					  </li>
					  <li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Embed Code</button>
					  </li>
					</ul>
					<div class="tab-content" id="myTabContent">
					  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="mb-3 mt-4 text-center">
							<label for="img">
								<img class="img-thumbnail img" id="view" src="{{ asset('/assets/images/upload.png') }}"/>
								<input type="text"  name="userFile"  id="img" class="form-control d-none" >
							</label>
							
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div>
					  
					  </div>
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						  <div class="mb-3 mt-2">
							<textarea name="embed" type="text" rows="5" placeholder="Enter your embed code..." class="form-control"></textarea>
							<div class="form-text text-muted">find width="xxx" then replace width="100%"</div>
						  </div>
					  </div>
					</div>
						
					</div>
				</div>

			 
				<div class="text-end mt-4">
					<button id="btn-action" type="submit" class="btn btn-indigo">Submit Article <i class="ph-paper-plane-tilt ms-2"></i></button>
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
	<script src="{{ asset('assets/dashboard/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>	
	<script src="{{ asset('assets/file-manager/js/stand-alone-button.js') }}"></script>	
	<script src="{{ asset('assets/dashboard/js/vendor/forms/selects/select2.min.js') }}"></script>
	
<script>
	 
	$('.form-control-select2').select2({
	minimumResultsForSearch: Infinity
	});	
	let route_prefix = BaseUrl+"/filemanager";
	let typeForm = 'create';
	let path;
	
	function getCategories() {
        $.ajax({
            url:  ServUrl+"/categories/list_all",
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                let html = '';
					html += '<option selected value="">Category</option>';
                $.each(response.data.categories, function(k,v){
                    html += '<option value="'+v.id+'">';
                    html += v.name;
                    html += '</option>';
                })
                $('select[name=category_id]').html(html);
            }
        })
		getTags();
    }
    getCategories();
	
	function getTags() {
        $.ajax({
            url: ServUrl+'/tags/list_all',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                let html = '';
					
                $.each(response.data.tags, function(k,v){
                    html += '<option value="'+v.name+'">';
                    html += v.name;
                    html += '</option>';
                })
                $('select[name=tag]').html(html);
				$('.multiselect').multiselect();
            }
        })
    }
	
	<?php if(isset($data['article_id'])){ ?>
	let id = '{{ $data['article_id'] }}';
	<?php } ?>
	function loadArticle() {
        $.ajax({
            url: ServUrl+'/articles/detail',
            data: {'id' : id},
            type: 'GET',
            dataType: 'JSON',
			complete: (response) => {
				if(response.status == 200) {
				var articles = response.responseJSON.data.articles;
                   $('input[name=id]').val(articles.id);
                   $('input[name=title]').val(articles.title);
                   $('select[name=category_id]').val(articles.category_id).trigger( 'change');
				   $('input[name=tags]').val(articles.tags);
				   $('input[name=date]').val(articles.date);
				   $('textarea[name=content]').summernote('pasteHTML', articles.content);
				   $('textarea[name=keyword]').val(articles.keyword);
				   $('textarea[name=description]').val(articles.description);
				   $('textarea[name=caption]').val(articles.caption);
				   if(articles.headline){
					$('input[name=headline][value='+articles.headline+']').prop("checked",true);
				   }
				   $('#view').attr('src', articles.img);
				   if(articles.tags){
					   var tags = articles.tags.split(',')
						$.each(tags, function(x,y){
							 $('option[value="'+y+'"]', $('.multiselect')).prop('selected', true);
							 $('option[value="'+y+'"]', $('.multiselect')).attr('selected', 'selected');
							 
						});
				   }
					//
					$('select[name=tag]').multiselect('rebuild');
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
		addDefaultFonts: false,
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
	var tag = $('.multiselect').val();
	$('input[name=tags]').val(tag);
	
	$('#btn-action').addClass('d-none');
	$('#btn-loading').removeClass('d-none');
	if(typeForm == 'update'){
		path = ServUrl+"/articles/update";
	}else{
		path = ServUrl+"/articles/create";
	} 
	var form = $("#form-create")[0]; 
	var data = new FormData(form);
	
	swalInit.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, save it!',
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
								title: 'Saved!',
								text: response.responseJSON.message,
								icon:'success'
							}); 
						$('#btn-action').removeClass('d-none');
						$('#btn-loading').addClass('d-none'); 
						setTimeout(function(){
							location.href = BaseUrl+'/dashboard/articles/detail/'+response.responseJSON.data.id;
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
	
	<?php if(isset($data['article_id'])){ ?>
	loadArticle();
	<?php } ?>
</script> 
	
@endsection

