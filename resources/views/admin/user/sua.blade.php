@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{ $user->name }}</small>
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
                    <form action="/admin/user/sua/{{ $user->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Name" value="{{ $user->name }}" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled="" class="form-control" name="Email" value="{{ $user->email }}"/>
                        </div>
                        <div class="form-group">
                            <input id="changePassword" type="checkbox" name="changePassword">
                            <label for="changePassword">Đổi mật khẩu</label>
                            <input disabled="" type="password" class="form-control password" name="Password" placeholder="Điền vào password" />
                        </div>
                        <div class="form-group">
                            <label>Nhập lại Password</label>
                            <input disabled type="password" class="form-control password" name="PasswordAgain" placeholder="Nhập lại password" />
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <label class="radio-inline">
                                <input name="Quyen" value="1"
                                       @if($user->quyen === 1)
                                       {{ "checked" }}
                                       @endif
                                       type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="Quyen" value="0"
                                       @if($user->quyen === 0)
                                       {{ "checked" }}
                                       @endif
                                       type="radio">Thường
                            </label>

                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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

        $("button[type='reset']").on("click", function() {
            console.log(123);
            $("input[name=Ten]").attr("value", "");
        });
    </script>
@endsection
