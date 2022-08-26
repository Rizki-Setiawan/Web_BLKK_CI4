<?= $this->extend('layout_backend/page_layout') ?>

<?= $this->section('content_backend') ?>
<div class="container">
	<div class="card">
		<div class="card-header" align="left">
			<h3>Data Berita</h3>
		</div>
		<div class="card-body">
			<?php if (!empty(session()->getFlashdata('message'))) : ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<?php echo session()->getFlashdata('message'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif; ?>
		<a href="<?= base_url('backend/berita/create'); ?>" class="btn btn-primary">Tambah</a>
		<hr />
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="40%">Title</th>
						<th>Author</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($berita as $row): ?>
						<tr>
							<td><?= $no++; ?></td>
							<td>
								<strong><?= $row->title ?></strong><br>
								<small class="text-muted"><i class="fa fa-calendar"></i>&nbsp<?= $row->created_at ?></small>
							</td>
							<td><?= $row->author ?></td>
							<td>
								<?php if($row->status === 'published'): ?>
									<small class="text-success"><b><?= $row->status ?></b></small>
									<?php else: ?>
										<small class="text-warning"><b><?= $row->status ?></b></small>
									<?php endif ?>
								</td>
								<td>
									<a title="Preview" href="<?= base_url("blkk/berita/$row->slug"); ?>" class="btn btn-sm btn-success">Preview</a>
									<a title="Edit" href="<?= base_url("backend/berita/edit/$row->id"); ?>" class="btn btn-sm btn-primary">Edit</a>
									<a title="Hapus" href="#" data-href="<?= base_url("backend/berita/delete/$row->id") ?>" onclick="confirmToDelete(this)" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<h2 class="h2">Apakah anda yakin?</h2>
							<p>Data akan dihapus permanen.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
							<a href="#" role="button" id="delete-button" class="btn btn-danger">Hapus</a>
						</div>
					</div>
				</div>
			</div>

			<script>
				function confirmToDelete(el){
					$("#delete-button").attr("href", el.dataset.href);
					$("#confirm-dialog").modal('show');
				}
			</script>

		</div>
	</div>
</div>                  

<?= $this->endSection() ?>