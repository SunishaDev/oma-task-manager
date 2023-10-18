<div class="container">
    <div class="card form">
        <a href="<?= base_url('tasks') ?>"><strong>  <i class="fa fa-arrow-left"></i> Back</strong></a>
        <?= form_open('create-task'); ?>
        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Project</label>
                <select id="project" name="p_id" required>
                <option value="" selected></option>
                <?php foreach($projects as $project){ ?>
                    <option value="<?= $project->id ?>"><?= $project->name ?></option>
                <?php } ?>
                </select>
            </div>
            <div class=" form-group row p-0 col-md-12 optionBox">
                <div class="form-row col-md-12">
                    <div class="col-6 fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Task</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Task title" name="title[]" value="" required/>
                    </div>
                    <div class="col-3 fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Due Date</label>
                        <input type="date" class="form-control form-control-solid" name="due_date[]" value="" required/>
                    </div>
                    <div class="col-2 fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Status</label>
                        <select id="status" name="status[]" required>
                            <option value="Pending" selected>Pending</option>
                            <option value="In Progress" >In Progress</option>
                            <option value="On Hold" >On Hold</option>
                            <option value="Completed" >Completed</option>
                            <option value="Cancelled" >Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="block mb-5  col-md-12" style="text-align: right;">
                    <span class="add addSession float-right" style="width: fit-content; cursor: pointer;" ><i class="fa fa-plus"></i></span>
                </div> 
            </div> 
            <div class="fv-row mt-7 float-right">
                <input type="submit" class="button" value="Save">
            </div>
        <?= form_close(); ?>
   </div>
</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
    $(document).on('click', '.add', function(){
        $('.block:last').before(`<div class="form-row col-md-12">
                    <div class="col-6 fv-row mb-7">
                        <input type="text" class="form-control form-control-solid" placeholder="Task title" name="title[]" value="" />
                    </div>
                    <div class="col-3 fv-row mb-7">
                        <input type="date" class="form-control form-control-solid" name="due_date[]" value="<?= date('Y-m-d'); ?>" />
                    </div>
                    <div class="col-2 fv-row mb-7">
                        <select id="status" name="status[]" >
                            <option value="Pending" selected>Pending</option>
                            <option value="In Progress" >In Progress</option>
                            <option value="On Hold" >On Hold</option>
                            <option value="Completed" >Completed</option>
                            <option value="Cancelled" >Cancelled</option>
                        </select>
                        
                    </div>
                    <div class="col-1 fv-row mb-7">
                        <span class="remove ">x</span>
                    </div>
                </div>`);
        
    });

    $(document).on('click','.remove',function() {
        $(this).parent().remove();
    });		
</script>