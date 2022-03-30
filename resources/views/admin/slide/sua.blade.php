@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>{{ $slide->Ten }}</small>
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
                    <form name="myForm" action="/admin/slide/them" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Điền vào tên" value="{{ $slide->Ten }}"/>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <input name="NoiDung" class="form-control" value="{{ $slide->NoiDung }}">
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <p>
                                <img type="file" width="400px" src="/upload/slide/{{ $slide->Hinh }}">
                            </p>
                            <input type="file" class="form- control" name="Hinh"/>
                        </div>
                        <div class="form-group">
                            <label>link</label>
                            <input class="form-control" name="link" value="{{ $slide->link }}"/>
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
        // $("button[type='reset']").on("click", function() {
        //     $("input[name=Ten], input[name=NoiDung], input[name=link]").attr("value", "");
        //     $("input[type=file]").val("");
        // });

        let form = document.myForm;
        form.onreset = function() {
            return confirm("Ban co muon reset hay khong");
        }
    </script>
@endsection
