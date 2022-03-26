@php
    /** @var \App\Http\Controllers\TheLoaiController $theloai */
@endphp

@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể loại
                        <small>{{ $theloai->Ten }}</small>
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

                    <form action="/admin/theloai/sua/{{ $theloai->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <input class="form-control" name="Ten" value="{{ $theloai->Ten }}" placeholder="Điền tên thể loại"/>
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
        $("button[type='reset']").on("click", function() {
            console.log(123);
            $("input[name=Ten]").attr("value", "");
        });
    </script>
@endsection
