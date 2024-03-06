<!-- Modal untuk Tambah Album -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Tambah Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                <!-- NOTE tambahin url, dan method post -->
                <form action="aksi/album/aksi_tambah.php" method="post">
                  <div class="mb-3">
                    <label for="">Nama Album :</label>
                    <!-- NOTE kasih name="" di input -->
                    <input type="text" class="form-control" name="nama_album" required>
                  </div>
                  <div class="mb-3">
                    <label for="">Deskripsi :</label>
                    <!-- NOTE kasih name="" di textarea -->
                    <textarea class="form-control" name="deskripsi_album" id="" cols="30" rows="5"></textarea>
                  </div>
                  <div class="modal-footer">
                    <!-- NOTE ubah type button jadi submit, 
                    dan data-dismiss di hapus supaya modal nya engga ketutup sebelum ngirim data -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Hapus Album -->
        <div class="modal fade" id="hapus_album<?= $itemAlbum['album_id'] ?>" tabindex="-1" aria-labelledby="hapus_album<?= $itemAlbum['album_id'] ?>Label" aria-hidden="true">
          <div class="modal-dialog">
            <form action="aksi/album/aksi_hapus.php" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="hapus_album<?= $itemAlbum['album_id'] ?>Label">Hapus Album</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <input type="hidden" name="album_id" value="<?= $itemAlbum['album_id'] ?>">
                  <span>
                    Yakin mau menghapus <b><?= $itemAlbum['namaAlbum'] ?></b> beserta foto fotonya <br>
                    Foto dalam Album : <br>
                    <div class="d-flex flex-wrap justify-content-center">
                      <?php
                      $album_id = $itemAlbum['album_id'];
                      $baca_foto = mysqli_query($link, "SELECT * FROM foto WHERE album_id='$album_id'");
                      foreach ($baca_foto as $data_foto) : ?>
                        <img src="assets/<?= $data_foto['lokasiFile'] ?>" height="150px" class="me-1" alt="">
                      <?php endforeach ?>
                    </div>
                  </span>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Modal untuk Edit Album -->
        <div class="modal fade" id=<?= "editPhotoModal" . $index ?> tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addPhotoModalLabel">Edit Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Form tambah foto bisa ditambahkan di sini -->
                <form action="aksi/album/aksi_edit.php" method="POST">
                  <input type="text" hidden name="album_id" value=<?= $itemAlbum['album_id'] ?>>
                  <div class="form-group">
                    <label for="photoCaption">Title:</label>
                    <input type="text" name="nama_album" class="form-control" id="photoCaption" placeholder="Masukkan caption foto" value="<?= $itemAlbum['namaAlbum'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="">Caption :</label>
                    <textarea class="form-control" name="deskripsi_album" id="" cols="30" rows="5"><?= $itemAlbum['deskripsi'] ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Edit Album</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal untuk Tambah Foto -->
  <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPhotoModalLabel">Tambah Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form tambah foto bisa ditambahkan di sini -->
          <form action="aksi/foto/aksi_tambah.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="photoFile">Pilih Foto:</label>
              <input type="file" name="foto" class="form-control-file" id="photoFile" required>
            </div>
            <div class="form-group">
              <label for="photoCaption">Title:</label>
              <input type="text" name="judulFoto" class="form-control" id="photoCaption" placeholder="Masukkan caption foto" required>
            </div>
            <div class="mb-3">
              <label for="">Caption :</label>
              <textarea class="form-control" name="deskripsiFoto" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="photoAlbum">Album:</label><br>
              <select name="album" id="" class="form-control" required>
                <?php foreach ($dataAlbum as $itemAlbum) : ?>
                  <option value="<?= $itemAlbum['album_id'] ?>">
                    <?= $itemAlbum['namaAlbum'] ?>
                  </option>
                  
                  <?php endforeach; ?>
                </select>
              </div>
            <button type="submit" class="btn btn-primary">Upload Foto</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal untuk Komentar -->
  <div class="modal fade" id="commentModal<?= $data['foto_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="commentModal<?= $data['foto_id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="commentModal<?= $data['foto_id'] ?>Label">Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="login.php" method="post">
              <div class="modal-body">
                <!-- Isi komentar atau form komentar dapat ditambahkan di sini -->
                <div class="form-group">
                  <label for="commentText">Your Comment:</label>
                  <input type="text" name="isiKomentar" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="user_id" value="<?= $user_id ?>" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>" class="form-control" id="comment" placeholder="Komen disini">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <hr>
                <?php
                $foto_id = $data['foto_id'];
                $query_komen = mysqli_query($link, "SELECT * FROM komentarfoto,foto,user WHERE komentarfoto.foto_id=foto.foto_id AND komentarfoto.user_id=user.user_id AND foto.foto_id='$foto_id' ");
                foreach ($query_komen as $data) :
                ?>
                  <b style="margin-right: 5px;"><?= $data['username'] ?></b><?= $data['isiKomentar'] ?><br>
                <?php endforeach ?>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal untuk Komentar Home -->
      <div class="modal fade" id="commentModalHome<?= $data['foto_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="commentModal<?= $data['foto_id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="commentModal<?= $data['foto_id'] ?>Label">Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="aksi/foto/aksi_like.php?aksi=tambah&table=komentarfoto" method="post">
              <div class="modal-body">
                <!-- Isi komentar atau form komentar dapat ditambahkan di sini -->
                <div class="form-group">
                  <label for="commentText">Your Comment:</label>
                  <input type="text" name="isiKomentar" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="user_id" value="<?= $user_id ?>" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>" class="form-control" id="comment" placeholder="Komen disini">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <hr>
                <?php
                $foto_id = $data['foto_id'];
                $query_komen = mysqli_query($link, "SELECT * FROM komentarfoto,foto,user WHERE komentarfoto.foto_id=foto.foto_id AND komentarfoto.user_id=user.user_id AND foto.foto_id='$foto_id' ");
                foreach ($query_komen as $data) :
                ?>
                  <b style="margin-right: 5px;"><?= $data['username'] ?></b><?= $data['isiKomentar'] ?><br>
                <?php endforeach ?>
              </div>
            </form>
          </div>
        </div>
      </div>

