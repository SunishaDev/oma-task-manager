<div class="container">
 
    <div class="card form">
        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success" role="alert" id="d1">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  onclick="document.getElementById('d1').style.display='none'"  style="float: right;">&times;</a>    
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
            </div>
          <?php }  if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger" role="alert" id="d1">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  onclick="document.getElementById('d1').style.display='none'"  style="float: right;">&times;</a>    
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        <?php } ?>
        <a href="<?= base_url('projects') ?>"><strong>  <i class="fa fa-arrow-left"></i> Back</strong></a>
        <?= form_open('create-project'); ?>
        <div class="col-12 mb-5">
            <a href="<?= base_url('edit-project');?>/<?= $projectInfo->id; ?>" class="btn btn-primary float-right">Edit</a>
            <button type="button" class="btn btn-danger me-5 float-right" data-bs-toggle="modal" style="margin-right:7px">
                                <a href="#deleteProject" data-toggle="modal">Delete</a></button>
        </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Project</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Project Name" name="name" value="<?= $projectInfo->name ?>" readonly/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Description</label>
                <textarea class="form-control form-control-solid" placeholder="Enter Project Description" name="description" readonly><?= $projectInfo->description ?></textarea>
            </div>
            
            <div class="fv-row mt-7">
                <label class="form-label me-3 mt-5 mb-0">Status</label>
                <label class="switch">
                    <input type="checkbox" id="togBtn" name="status" value="1" <?= ($projectInfo->status == 1)?'checked':''; ?> disabled>

                    <div class="slider round"></div>
                </label>
            </div>
          <?= form_close(); ?>
   </div>
</div>	
<div id="deleteProject" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <form action="<?= base_url() ?>Home/deleteProject/<?= $projectInfo->id ?>" method="POST">
        <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close-btn close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this record? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn_btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn_btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
