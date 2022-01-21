<?php $this->load->view('admin/inc/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Articles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Articles</li>
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
                <?php if ($this->session->flashdata('message') != "") { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('msg') != "") { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('msg'); ?></div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <form id="searchForm" name="searchForm" method="get" action="">
                                <div class="input-group mb-0">
                                    <input type="text" value="" class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon 1">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <a href="<?php echo base_url().'admin/article/create';?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="50">#</th>
                                <th>Name</th>
                                <th width="100">Status</th>
                                <th width="160" class="text-center">Action</th>
                            </tr>
                           
                        </table>
                    </div>
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
<script type="text/javascript">
    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete the category?")) {
            window.location.href = '<?php echo base_url() . 'admin/category/delete/'; ?>' + id;
        }
    }
</script>