@extends('backend.layout')
@section('content')

    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Settings
                </h3>
            </div>
            <div class="box-body">
                <form action="{{route('settings.Update',['id' => $settings->id])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Description</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" readonly
                                       value="{{$settings->settings_description}}">
                            </div>
                        </div>
                    </div>

                    @if($settings->settings_type == 'file')
                        <div class="form-group">
                            <label>Choose Photo</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="file" required name="settings_value" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Content</label>
                        <div class="row">
                            <div class="col-xs-12">
                                @if($settings->settings_type=="text")
                                    <input type="text" class="form-control" name="settings_value" required
                                           value="{{$settings->settings_value}}">
                                @endif

                                @if($settings->settings_type=="textarea")
                                    <textarea name="settings_value"
                                              class="form-control">{{$settings->settings_value}}</textarea>
                                @endif

                                @if($settings->settings_type=="ckeditor")
                                    <textarea name="settings_value" id="editor1"
                                              class="form-control">{{$settings->settings_value}}</textarea>
                                @endif

                                @if($settings->settings_type=="file")
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" width="300" height="250"
                                             src="/images/settings/{{$settings->settings_value}}" alt="photo">
                                    </div>
                                @endif

                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>

                        @if($settings->settings_type=="file")
                            <input type="hidden" name="old_file" value="{{$settings->settings_value}}">
                        @endif

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
@section('css')@endsection
@section('js')@endsection
