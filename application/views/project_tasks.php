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
        <a href="javascript:history.back()"><strong>  <i class="fa fa-arrow-left"></i> Back</strong></a>
        <div class="header">
            <a href="<?= base_url('create-task'); ?>"><button class="btn btn-info addButton">Add New</button> </a> 
        </div> 
        <?php if(!empty($tasks)){
            $today = date('Y-m-d');
        ?>
            <h4>Project : <?= $project->name ?> </h4>
            <table class="table table-striped" >
                <thead>
                    <th>No.</th>
                    <th>Title </th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($tasks as $key=>$task){ ?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $task->title; ?></td>
                        <td ><span <?php if($today > $task->due_date){ echo 'style="background-color:#fb0000b3"'; } ?> ><?= date('d M, Y',strtotime($task->due_date));?></span></td>
                        <td><?= $task->status; ?></td>
                        <td>
                            <a href="<?= base_url('edit-task');?>/<?= $task->id; ?>" ><i class="fa fa-pen" style="color:green"></i></a>
                            <a  onclick="return checkDelete('<?= $task->title; ?>','<?= $task->id; ?>')"><i class="fa fa-trash" style="color:red"></i></a>
                        </td>
                    </tr>
                    <?php } ?>		
                </tbody>
            </table>
        <?php } else { ?>
            </br>
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>No task found.</h4>
                            </br>
                        </div>
                    </div>
                </div>
        <?php } ?>
   </div>
</div>	
<script language="JavaScript" type="text/javascript">
function checkDelete(task,id){
    
        if(!confirm('Are you sure you want to delete '+task+'?')){
            return false;
        }else{
            $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>Home/deleteTask",    
                    data:{id: id},
                    success: function(data){
                        location.reload();
                    }
                });
        }
    }

</script>			