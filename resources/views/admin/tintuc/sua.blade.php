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
                    <form action="/admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
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
                            <textarea id="ckeditor-tom-tat" name="TomTat" class="form-control ckeditor" rows="3">{{ $tintuc->TomTat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="ckeditor-noi-dung" name="NoiDung" class="form-control ckeditor" rows="3">{{ $tintuc->NoiDung }}</textarea>
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
                                       @if($tintuc->NoiBat == 0)
                                           {{ "checked" }}
                                       @endif
                                       type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                       @if($tintuc->NoiBat == 1)
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
    </script>
@endsection
