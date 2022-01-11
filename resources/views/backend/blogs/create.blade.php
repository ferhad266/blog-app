@extends('backend.layout')
@section('content')

    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Blog Add
                </h3>
            </div>
            <div class="box-body">
                <form action="{{route('blog.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Choose Photo</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="file" required name="blog_file" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" name="blog_title">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="text" name="blog_slug" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <div class="row">
                            <div class="col-xs-12">

                                    <textarea name="blog_content" id="editor1"
                                              class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <div class="row">
                                <div class="col-xs-12">

                                    <select name="blog_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Passive</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
@section('css')@endsection
@section('js')@endsection
