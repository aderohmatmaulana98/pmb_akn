<style>
    body {
        background: #eee
    }

    #regForm {
        background-color: #ffffff;
        margin: 0px auto;
        font-family: Raleway;
        padding: 40px;
        border-radius: 10px
    }

    h1 {
        text-align: center
    }

    input {
        padding: 10px;
        width: 500px;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa
    }

    select {
        padding: 10px;
        width: 500px;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa
    }

    input.invalid {
        background-color: #ffdddd
    }

    select.invalid {
        background-color: #ffdddd
    }

    .tab {
        display: none
    }

    button {
        background-color: #ff9933;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer
    }

    button:hover {
        opacity: 0.8
    }

    #prevBtn {
        background-color: #bbbbbb
    }

    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5
    }

    .step.active {
        opacity: 1
    }

    .step.finish {
        background-color: #4CAF50
    }

    .all-steps {
        text-align: center;
        margin-top: 30px;
        margin-bottom: 30px
    }

    .thanks-message {
        display: none
    }

    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }

    .container input[type="radio"] {
        position: absolute;
        opacity: 0;
        cursor: pointer
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%
    }

    .container:hover input~.checkmark {
        background-color: #ccc
    }

    .container input:checked~.checkmark {
        background-color: #2196F3
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none
    }

    .container input:checked~.checkmark:after {
        display: block
    }

    .container .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white
    }
</style>
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8 card">
            <div class="mt-3">
                <?= $this->session->flashdata('message');  ?>
            </div>
            <form id="regForm" action="<?= base_url('user/aksi_tambah_formulir') ?>" method="POST" enctype="multipart/form-data">
                <h1 id="register">Form Pendaftaran</h1>
                <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span></div>
                <div class="tab">
                    <label for="">Nama Lengkap</label>
                    <p><input type="text" placeholder="Nama Lengkap" oninput="this.className = ''" name="nama_lengkap"></p>
                    <label for="">Tempat Lahir</label>
                    <p><input type="text" placeholder="Tempat Lahir" oninput="this.className = ''" name="tempat_lahir"></p>
                    <label for="">Tanggal Lahir</label>
                    <p><input type="date" placeholder="Tanggal Lahir" oninput="this.className = ''" name="tgl_lahir"></p>
                    <label for="">Jenis Kelamin</label>
                    <p>
                        <select name="jenis_kelamin" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </p>
                    <p>
                        <select name="th_ajaran" oninput="this.className = ''" required hidden>
                            <?php foreach ($th_ajaran as $ta) : ?>
                                <option value="<?= $ta['id'] ?>" selected><?= $ta['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <label for="">Agama</label>
                    <p>
                        <select name="agama" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                        </select>
                    </p>
                    <label for="">No Handphone</label>
                    <p><input type="number" placeholder="No Handphone" oninput="this.className = ''" name="no_hp"></p>
                </div>
                <div class="tab">
                <label for="">Provinsi</label>
                    <p>
                        <select name="provinsi" id="provinsi" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Provinsi</option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <label for="">Kabupaten</label>
                    <p>
                        <select name="kabupaten" id="kabupaten" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Kabupaten</option>
                        </select>
                    </p>
                    <label for="">Kecamatan</label>
                    <p>
                        <select name="kecamatan" id="kecamatan" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Kecamatan</option>
                        </select>
                    </p>
                    <label for="">Alamat</label>
                    <p><input type="text" placeholder="Alamat" oninput="this.className = ''" name="alamat"></p>
                    <label for="">Prodi Pilihan</label>
                    <p>
                        <select name="prodi" oninput="this.className = ''" required>
                            <option value="" selected disabled>Pilih Prodi</option>
                            <option value="1">Tari</option>
                            <option value="2">Karawitan</option>
                            <option value="3">Kriya Kulit</option>
                        </select>
                    </p>
                    <label for="">Tahun Lulus</label>
                    <?php $years = range(1900, strftime("%Y", time())); ?>
                    <p>
                        <?php foreach($years as $year) ?>
                        <select oninput="this.className = ''" name="tahun_lulus">
                            <option selected disabled>Pilih Tahun Lulus</option>
                            <?php foreach($years as $year) : ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <label for="">Asal Sekolah</label>
                    <p><input placeholder="Asal Sekolah" oninput="this.className = ''" name="asal_sekolah"></p>
                    <label for="">Nama Orang Tua</label>
                    <p><input placeholder="Nama Orang Tua" oninput="this.className = ''" name="nama_ortu"></p>
                    <label for="">Pekerjaan Orang Tua</label>
                    <p><input placeholder="Pekerjaan Orang Tua" oninput="this.className = ''" name="pekerjaan_ortu"></p>
                    <label for="">No Handphone Orang Tua</label>
                    <p><input type="number" placeholder="No Handphone Orang Tua" oninput="this.className = ''" name="telepon_ortu"></p>
                </div>
                <div class="tab">
                    <p>
                    <label for="ka">KTP</label>
                    <p>
                    <input type="file" placeholder="Kartu Tanda Penduduk" oninput="this.className = ''" name="ktp"><br>
                    <small class="text-danger">*Upload dalam format PDF</small>
                    </p>
                    
                    </p>

                    <p>
                        <label for="ka">Kartu Keluarga</label>
                    <p><input type="file" placeholder="Kartu Keluarga" oninput="this.className = ''" name="kk"><br>
                    <small class="text-danger">*Upload dalam format PDF</small>
                    </p>
                    </p>

                    <p>
                        <label for="ka">Ijazah/SKL</label>
                    <p><input type="file" placeholder="Ijazah" oninput="this.className = ''" name="ijazah"><br>
                    <small class="text-danger">*Upload dalam format PDF</small>
                </p>
                    
                    </p>
                    <p>
                        <label for="ka">Pas Foto</label>
                    <p><input type="file" placeholder="Pas Foto" oninput="this.className = ''" name="pas_foto"><br>
                    <small class="text-danger">*Upload dalam format JPG/JPEG/PNG</small>
                </p>
                    </p>
                </div>
                <!-- <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Thanks for your Donation!</h3> <span>Your donation has been entered! We will contact you shortly!</span>
                </div> -->
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //your javascript goes here
    var currentTab = 0;
    document.addEventListener("DOMContentLoaded", function(event) {


        showTab(currentTab);

    });

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {
            document.getElementById("regForm").submit();
            return false;
            alert("sdf");
            document.getElementById("nextprevious").style.display = "none";
            document.getElementById("all-steps").style.display = "none";
            document.getElementById("register").style.display = "none";
            document.getElementById("text-message").style.display = "block";




        }
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        z = x[currentTab].getElementsByTagName("select");
        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].className += "invalid";
                valid = false;
            }
        }
        for (i = 0; i < z.length; i++) {
            if (z[i].value == "") {
                z[i].className += "invalid";
                valid = false;
            }
        }
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid;
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/kabupaten') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten').html(response);
                }
            });
        });

        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/kecamatan') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kecamatan').html(response);
                }
            });
        });
    });
</script>