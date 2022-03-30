@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>{{ $tintuc->TieuDe }}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{ $err }} <br>
                            @endforeach
                        </div>
                    @endif

                    @if(session("thongbao"))
                        <div class="alert alert-success">
                            {{ session("thongbao") }}
                        </div>
                    @endif
                    <form name="myForm" action="/admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="theloai">
                                @foreach($theloai as $tl)
                                    <option
                                        @if($tintuc->loaitin->theloai->id == $tl->id) {{--id của thể loại hiện tại = với id của thể loại trong databases--}}
                                            {{ "selected" }}
                                        @endif
                                        value="{{ $tl->id }}">{{ $tl->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="LoaiTin" id="loaitin">
                                @foreach($loaitin as $lt)
                                    <option
                                        @if($tintuc->loaitin->id == $lt->id) {{--id của loại tin hiện tại = với id của loại tin trong databases--}}
                                            {{ "selected" }}
                                        @endif
                                        value="{{ $lt->id }}">{{ $lt->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Điền vào tiêu đề" value="{{ $tintuc->TieuDe }}" />
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea id="ckeditorTomTat" name="TomTat" class="form-control ckeditor" rows="3">{!! $tintuc->TomTat  !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="ckeditorNoiDung" name="NoiDung" class="form-control ckeditor" rows="3">{{ $tintuc->NoiDung }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img type="file" width="400px" src="/upload/tintuc/{{ $tintuc->Hinh }}">
                            <input type="file" class="form- control" name="Hinh"/>
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0"
                                       @if($tintuc->NoiBat === 0)
                                           {{ "checked" }}
                                       @endif
                                       type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                       @if($tintuc->NoiBat === 1)
                                           {{ "checked" }}
                                       @endif
                                       type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comment
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Người dùng</th>
                        <th class="text-center">Nội dung</th>
                        <th class="text-center">Ngày đăng</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc->comment as $cm)
                        <tr class="odd gradeX">
                            <td class="text-center">{{ $cm->id }}</td>
                            <td class="text-center">{{ $cm->user->name }}</td>
                            <td class="text-center">{{ $cm->NoiDung }}</td>
                            <td class="text-center">{{ $cm->created_at }}</td>
                            <td class="text-center"><i class="fa fa-trash-o  fa-fw"></i><a href="/admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}">Xóa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--End row comment--}}
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function() {
            $("#theloai").change(function() {
                let idTheLoai = $(this).val();

                $.get("/admin/ajax/loaitin/" + idTheLoai, function(data) {
                    $("#loaitin").html(data);
                });
            });
        });

/*
        let valTomTat = {!! json_encode($tintuc->TomTat, JSON_THROW_ON_ERROR) !!};
        let valNoiDung = {!! json_encode($tintuc->NoiDung, JSON_THROW_ON_ERROR) !!};
*/

        // console.log(valNoiDung);

        // $("button[type='reset']").on("click", function() {
            // console.log(123);
            // $("input[name=TieuDe]").attr("value", "");
{{--            CKEDITOR.instances.ckeditorTomTat.setData( '{!! $tintuc->TomTat  !!}' );--}}

            // CKEDITOR.instances.ckeditorTomTat.setData(valTomTat);
{{--            CKEDITOR.instances.ckeditorNoiDung.setData( '{!! $tintuc->NoiDung  !!}' );--}}
//             CKEDITOR.instances.ckeditorNoiDung.setData(valNoiDung);

            // $("input[name=Hinh]").val("");
        // });


        // Reset Form
        // $("button[type='reset']").on("click", function() {
        //     $("input[name=Ten], input[name=NoiDung], input[name=link]").attr("value", "");
        //     $("input[type=file]").val("");
        // });

        let form = document.myForm;
        form.onreset = function() {
            let val = confirm("Ban co muon reset hay khong");

            if (val === true) {
                let valTomTat = {!! json_encode($tintuc->TomTat, JSON_THROW_ON_ERROR) !!};
                let valNoiDung = {!! json_encode($tintuc->NoiDung, JSON_THROW_ON_ERROR) !!};

                CKEDITOR.instances.ckeditorTomTat.setData(valTomTat);
                CKEDITOR.instances.ckeditorNoiDung.setData(valNoiDung);
            }

            return val;
        }
    </script>

@endsection
