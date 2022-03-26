@extends("layout.index")
@section('title', "Đăng ký")

@section("content")
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng ký tài khoản</div>
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
                        <form method="post" action="/dangky">
                            @csrf
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Username" name="Name" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="Email" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập mật khẩu</label>
                                <input type="password" class="form-control password" name="Password" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="PasswordAgain" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Đăng ký</button>
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

