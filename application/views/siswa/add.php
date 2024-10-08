<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Siswa</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
        echo form_open_multipart('siswa/add', 'role="form" class="form-horizontal"');
        ?>

        <div class="box-body">

          <div class="form-group">
            <label class="col-sm-2 control-label">NIS</label>

            <div class="col-sm-9">
              <input type="text" name="nim" class="form-control" placeholder="Masukkan NIS">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Tempat, Tgl Lahir</label>

            <div class="col-sm-5">
              <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
            </div>

            <div class="col-sm-2">
              <input type="date" name="tanggal_lahir" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Gender</label>

            <div class="col-sm-5">
              <?php
              echo form_dropdown('gender', array('Pilih Gender', 'L' => 'Laki-Laki', 'P' => 'Perempuan'), null, "class='form-control'");
              ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Agama</label>

            <div class="col-sm-5">
              <?php
              echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama');
              ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Foto</label>

            <div class="col-sm-5">
              <input type="file" name="userfile">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Kelas</label>

            <div class="col-sm-5">
              <?php
              echo cmb_dinamis('kelas', 'tbl_kelas', 'nama_kelas', 'kd_kelas');
              ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"></label>

            <div class="col-sm-1">
              <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
            </div>

            <div class="col-sm-1">
              <?php
              echo anchor('siswa', 'Kembali', array('class' => 'btn btn-danger btn-flat'));
              ?>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>