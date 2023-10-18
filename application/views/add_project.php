<div class="container">
    <div class="card form">
    <a href="javascript:history.back()"><strong>  <i class="fa fa-arrow-left"></i> Back</strong></a>
        <?= form_open(base_url('create-project')); ?>
        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Project</label>
                <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                <input type="text" class="form-control form-control-solid" placeholder="Enter Project Name" name="name" value="" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Description</label>
                <textarea class="form-control form-control-solid" placeholder="Enter Project Description" name="description"></textarea>
            </div>
            <div class="fv-row mt-7">
                <label class="form-label me-3 mt-5 mb-0">Status</label>
                <label class="switch">
                    <input type="checkbox" id="togBtn" name="status" value="1" checked>
                    <div class="slider round"></div>
                </label>
            </div>
            <div class="fv-row mt-7 float-right">
                <input type="submit" class="button" value="Save">
            </div>
        <?= form_close(); ?>
   </div>
</div>			