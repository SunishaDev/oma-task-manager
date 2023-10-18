<div class="container">
    <div class="card table-responsive table-full-width">
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
        <div class="header">
            <a href="<?= base_url('create-project'); ?>"><button class="btn btn-info addButton">Add New</button> </a> 
        </div> 
        <?php if(!empty($projects)){ ?>
            <table class="table table-striped" >
                <thead>
                    <th>No.</th>
                    <th>Title </th>
                    <th>No of Tasks</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($projects as $key=>$project){ 
                        $projectName      =    str_replace(' ', '-', strtolower($project->name));
                        $projectName     = preg_replace('/[^A-Za-z0-9\-]/', '', $projectName );
                        $projectName     = str_replace('/', '&', $projectName);
                    ?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $project->name; ?></td>
                        <td><?= $project->no_of_task;?></td>
                        <td><?= ($project->status == 1)?'Active':'Inactive';?></td>
                        <td><a href="<?= base_url('view-project');?>/<?= $project->id; ?>" class="btn btn-success">View</a>
                        <a href="<?= base_url('tasks');?>/<?= $projectName ?>/<?= $project->id; ?>" class="btn btn-primary">Tasks</a></td>
                    </tr>
                    <?php } ?>		
                </tbody>
            </table>
        <?php } else { ?>
            </br>
                <div class=" text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>No projects found.</h4>
                            </br>
                        </div>
                    </div>
                </div>
        <?php } ?>
   </div>
</div>			