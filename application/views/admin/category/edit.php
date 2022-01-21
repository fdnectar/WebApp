<?php $this->load->view('admin/inc/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/category/index'; ?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Categories</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Edit Category "<?php echo $categories['name']; ?>"</h5>
                        </div>
                    </div>
                    <form action="<?php echo base_url() . 'admin/category/edit/'.$categories['id']; ?>" name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" value="<?php echo set_value('name', $categories['name']); ?>" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>">
                                <?php echo form_error('name'); ?>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" id="image" class="<?php echo (!empty($errorImageUpload)) ? 'is-invalid' : ''; ?>">
                                <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : ''; ?>
                                <br>
                                <?php if ($categories['image'] != "") { ?>
                                    <img width="250" class="mt-3" src="<?php echo base_url() . 'assets/images/category/thumb/' . $categories['image'] ?>" alt="">
                                <?php } else { ?>
                                    <img width="250" src="<?php echo base_url() . 'assets/images/category/noimage.jpg'; ?>">
                                <?php } ?>

                            </div>

                            <div class="custom-control custom-radio float-left">
                                <input type="radio" id="statusActive" name="status"  class="custom-control-input" vlaue="1" <?php echo ($categories['status'] == 1) ? 'checked' : '';?>>
                                <label for="statusActive" class="custom-control-label">Active</label>
                            </div>
                            <div class="custom-control custom-radio float-left ml-3">
                                <input type="radio" id="statusInactive" name="status" class="custom-control-input" vlaue="0" <?php echo ($categories['status'] == 0) ? 'checked' : '';?>>
                                <label for="statusInactive" class="custom-control-label">Inactive</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url() . 'admin/category/index'; ?>" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<?php $this->load->view('admin/inc/footer'); ?>