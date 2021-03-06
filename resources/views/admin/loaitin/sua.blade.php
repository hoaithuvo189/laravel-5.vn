@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại tin
                        <small>{{ $loaitin->Ten }}</small>
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
                    <form name="myForm" action="/admin/loaitin/sua/{{ $loaitin->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai">
                                @foreach($theloai as $tl)
                                    <option {{ ($loaitin->idTheLoai === $tl->id) ? "selected" : "" }} value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tên Loại Tin</label>
                            <input class="form-control" name="Ten" value="{{ $loaitin->Ten }}" placeholder="Điền tên loại tin" />
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
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
        //     console.log(123);
        //     $("input[name=Ten]").attr("value", "");
        // });

        let form = document.myForm;
        form.onreset = function() {
            return confirm("Ban co muon reset hay khong");
        }
    </script>
@endsection
