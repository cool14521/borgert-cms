@extends('admin.gallerys.index')

@section('title', 'Cadastro de galeria ', @parent)

@section('stylesheet')

    @parent
    
    <!-- Blueimp Jquery File Upload -->
    <link href="{!! asset('assets/components/blueimp-file-upload/css/jquery.fileupload.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/components/blueimp-file-upload/css/jquery.fileupload-ui.css') !!}" rel="stylesheet">

@show

@section('actions')
    <a href="{{ route('admin.gallerys.list') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> Voltar</a>
@endsection

@section('gallerys')
	
	@section('subtitle', 'Cadastro de galeria')

	<div class="tabs-container">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-conteudo"> Conteúdo</a></li>
            <li><a data-toggle="tab" href="#tab-imagens"> Imagens</a></li>
        </ul>
        
        <form action="{{ route('admin.gallerys.store') }}" class="fileupload" method="post" enctype="multipart/form-data">

            <div class="tab-content">
            
                <div id="tab-conteudo" class="tab-pane active">
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <fieldset class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Título:</label>
                                <div class="col-sm-10"><input type="text" name="title" class="form-control"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Conteúdo:</label>
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control summernote"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status:</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10"><button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Criar</button></div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div id="tab-imagens" class="tab-pane">
                    <div class="panel-body">
                        @include('admin._inc.fileupload.buttons')
                    </div>
                </div>

            </div>
        
        </form>

	</div>

@endsection


@section('javascript')

    @parent

    @include('admin._inc.fileupload.upload')
    @include('admin._inc.fileupload.download')

    <!-- Blueimp Jquery File Upload -->
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/vendor/jquery.ui.widget.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-tmpl/js/tmpl.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-load-image/js/load-image.all.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.iframe-transport.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-process.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-image.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-audio.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-video.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-validate.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/components/blueimp-file-upload/js/jquery.fileupload-ui.js') !!}"></script>

    <script type="text/javascript">

        // Initialize the jQuery File Upload widget:
        $('.fileupload').fileupload({
            autoUpload: true,
            url: '{{ route('admin.gallerys.upload') }}',
        });

         // Load existing files:
        $('.fileupload').addClass('fileupload-processing');

        $.ajax({
            url: $('.fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('.fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
        });



// $('#post-form').fileupload({
//        url: 'http://example.com/upload',
//         autoUpload: true,
//         previewMaxWidth: 120,
//         previewMaxHeight: 90,
//         acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
//         maxFileSize: 10240000, // 10 MB
//         minFileSize: undefined, // No minimal file size
//         maxNumberOfFiles: 20
//     });

    </script>

@stop