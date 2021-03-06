@extends("layout.index")
@section('title', "Thông tin tài khoản")

@section("content")
<div class="container">
    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin tài khoản</div>
                <div class="panel-body">
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
                    <form action="/nguoidung" method="post">
                        @csrf
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="Name" aria-describedby="basic-addon1" value="{{ auth()->user()->name }}">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="Email" aria-describedby="basic-addon1" disabled value="{{ auth()->user()->email }}">
                        </div>
                        <br>
                        <div>
                            <input id="changePassword" type="checkbox" name="changePassword">
                            <label for="changePassword">Đổi mật khẩu</label>
                            <input type="password" class="form-control password" name="Password" aria-describedby="basic-addon1" disabled="">
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control password" name="PasswordAgain" aria-describedby="basic-addon1" disabled="">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-default">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
@endsection

@section("script")
    <script>
        $("document").ready(function() {
            $("#changePassword").change(function() {
                if($(this).is(":checked")) {
                    $(".password").removeAttr("disabled");
                } else {
                    $(".password").attr("disabled", "");
                }
            });
        });
    </script>
@endsection
