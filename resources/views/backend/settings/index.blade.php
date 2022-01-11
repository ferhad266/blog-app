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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Keyword</th>
                        <th>Content</th>
                        <th>Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($data['adminSettings'] as $key)
                        <tr id="item-{{$key->id}}">
                            <td>{{$key->id}}</td>
                            <td class="sortable">{{$key->settings_description}}</td>
                            <td>
                                @if($key->settings_type=="file")
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" width="150" height="150"
                                             src="/images/settings/{{$key->settings_value}}" alt="photo">
                                    </div>
                                @else
                                    {{$key->settings_value}}
                                @endif
                            </td>
                            <td>{{$key->settings_key}}</td>
                            <td>{{$key->settings_type}}</td>
                            <td width="5">
                                <a href="{{route('settings.Edit',['id' => $key->id])}}"><i
                                        class="fa fa-pencil-square-o"></i></a>
                            </td>
                            <td width="5">
                                @if($key->settings_delete)
                                    <a href="javascript:void(0)">
                                        <i id="@php echo $key->id; @endphp" class="fa fa-trash-o"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('settings.Sortable')}}",
                        success: function (msg) {
                            if (msg) {
                                alertify.success("Success!")
                            } else {
                                alertify.error('Not success!');
                            }
                        }
                    });
                }
            });
            $('#sortable').disableSelection();

        });

        $('.fa-trash-o').click(function () {
            destroy_id = $(this).attr('id');

            alertify.confirm('Are u want to delete ? ', 'This process is not rollback',
                function () {
                    location.href = "/nedmins/settings/delete/" + destroy_id;
                },
                function () {
                    alertify.error('Delete process is invalid!');
                }
            );
        });
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
