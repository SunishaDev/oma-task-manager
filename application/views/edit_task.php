<div class="container">
    <div class="card form">
    <a href="<?= base_url('tasks') ?>"><strong>  <i class="fa fa-arrow-left"></i> Back</strong></a>
        <?= form_open('edit-task/'.$taskInfo->id); ?>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Task</label>
                <input type="text" class="form-control form-control-solid" placeholder="Task Tile" name="title" value="<?= $taskInfo->title ?>" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Project</label>
                <select id="project" name="p_id" required>

                <?php foreach($projects as $project){ ?>
                    <option value="<?= $project->id ?>" <?= ($taskInfo->p_id ==$project->id)?'Selected':''; ?>><?= $project->name ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Due Date</label>
                <input type="date" class="form-control form-control-solid" name="due_date" value="<?= $taskInfo->due_date ?>" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select id="status" name="status" required>
                    <option value="Pending" <?= ($taskInfo->status =='Pending')?'Selected':''; ?>>Pending</option>
                    <option value="In Progress" <?= ($taskInfo->status =='In Progress')?'Selected':''; ?>>In Progress</option>
                    <option value="On Hold" <?= ($taskInfo->status =='On Hold')?'Selected':''; ?> >On Hold</option>
                    <option value="Completed"  <?= ($taskInfo->status =='Completed')?'Selected':''; ?>>Completed</option>
                    <option value="Completed" <?= ($taskInfo->status =='Completed')?'Selected':''; ?>>Cancelled</option>
                </select>
            </div>
            <div class="fv-row mt-7 float-right">
                <input type="submit" class="button" value="Update">
            </div>
        <?= form_close(); ?>
   </div>
</div>			