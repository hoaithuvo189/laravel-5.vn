@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Thêm</small>
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
                    <form name="myForm" action="/admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="theloai">
                                @foreach($theloai as $tl)
                                    <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="LoaiTin" id="loaitin">
                                @foreach($loaitin as $lt)
                                    <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Điền vào tiêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea id="ckeditorTomTat" name="TomTat" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="ckeditorNoiDung" name="NoiDung" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form- control" name="Hinh"/>
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" type="radio">Có
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

        // Reset form
        // $("button[type='reset']").on("click", function() {
        //     $("input[name=Ten], input[name=NoiDung], input[name=link]").attr("value", "");
        //     $("input[type=file]").val("");
        // });

        let form = document.myForm;
        form.onreset = function() {
            let val = confirm("Ban co muon reset hay khong");

            if (val === true) {
                CKEDITOR.instances.ckeditorTomTat.setData('');
                CKEDITOR.instances.ckeditorNoiDung.setData('');
            }

            return val;
        }
    </script>
@endsection
