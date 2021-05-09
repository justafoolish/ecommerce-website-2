<!-- Modal đăng nhập đăng ký -->
<div class="modal" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header border-bottom-0 p-2 px-3 ">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times text-danger"></i></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pb-2">
            <form method="post" class="px-3" action="login.php">
                <h2 class="modal-title mb-3">Đăng Nhập</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="passwd">Mật khẩu</label>
                    <input type="password" name="passwd" id="passwd" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-secondary mt-4 btn-block py-2 mb-3 font-weight-bold text-uppercase" name="login">Đăng Nhập</button>
                <p class="mb-3">Bạn chưa có tài khoản?
                    <a class="text-info font-weight-bold border-0 bg-transparent text-decoration-none" style="cursor: pointer;" data-toggle="modal" data-target="#registryModal" data-dismiss="modal">Đăng Ký</a>
                </p>
            </form>
        </div>
        
        
      </div>
    </div>
  </div>

  <div class="modal" id="registryModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header border-bottom-0 p-2 px-3">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times text-danger"></i></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pb-2">
            <form method="POST" class="px-3" action="registry.php">
                <h2 class="modal-title mb-3">Đăng Ký</h2>
                <div class="form-group">
                    <label for="Name">Họ và tên</label>
                    <input type="text" name="Name" id="Name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email </label>
                    <input type="email" name="Email" id="Email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contact">Số điện thoại</label>
                    <input type="text" name="contact" id="contact" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-secondary mt-4 btn-block py-2 mb-3 font-weight-bold text-uppercase" name="registry">Đăng Ký</button>
                <p class="mb-3">Bạn đã có tài khoản?
                    <a class="text-info font-weight-bold border-0 bg-transparent text-decoration-none" style="cursor: pointer;" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Đăng Nhập</a>
                </p>
            </form>
        </div>


        
        
      </div>
    </div>
  </div>
