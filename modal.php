<!-- Admin Modal -->
<div class="modal fade" id="maModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Admin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST">
                    <label>Username</label><br>
                    <input type="text" class="form-control bg-light border-1 small"placeholder="Masukan data" name="username" required><br>
                    <label>Password</label><br>
                    <input type="password" class="form-control bg-light border-1 small"placeholder="Masukan data" name="password" required><br>
                    <label>Confirm Password</label><br>
                    <input type="password" class="form-control bg-light border-1 small"placeholder="Masukan data" name="cpassword" required><br>
                    <button name="submit" class="btn btn-primary btn-md mb-3 mt-3">Simpan</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Post Modal -->