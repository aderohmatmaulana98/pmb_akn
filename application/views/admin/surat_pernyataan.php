<section class="container-fluid col-lg-10">
    <?= $this->session->flashdata('message');  ?>

    <!-- This container will become the editable. -->
    <form action="<?= base_url('admin/aksi_surat_pernyataan') ?>" method="POST">
        <textarea name="editor1" id="editor1"><?= $surat_pernyataan['surat_pernyataan']; ?></textarea>
        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>

</section>
</div>


<script>
    CKEDITOR.replace('editor1');
</script>