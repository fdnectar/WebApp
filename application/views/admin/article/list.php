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
                <!-- //adding article ,essage -->
                <?php if ($this->session->flashdata('message') != "") { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                <?php } ?>
                <!-- //deleting article message -->
                <?php if ($this->session->flashdata('success') != "") { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php } ?>
                <!-- //article not found message -->
                <?php if ($this->session->flashdata('error') != "") { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <form id="searchForm" name="searchForm" method="get" action="">
                                <div class="input-group mb-0">
                                    <input type="text" value="<?php echo $q;?>" class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon 1">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <a href="<?php echo base_url() . 'admin/article/create'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="50">#</th>
                                <th width="100">Image</th>
                                <th>Title</th>
                                <th width="180">Author</th>
                                <th width="100">Created</th>
                                <th width="70">Status</th>
                                <th width="140" class="text-center">Action</th>
                            </tr>

                            <?php if ($articles) { ?>
                                <?php foreach ($articles as $article) { ?>
                                    <tr>
                                        <td><?php echo $article['id'] ?></td>
                                        <td>
                                            <?php $path = './assets/images/articles/thumb_admin/' . $article['image'];
                                            if ($article['image'] != "" && file_exists($path)) { ?>
                                                <img class="w-100" src="<?php echo base_url('assets/images/articles/thumb_admin/' . $article['image']); ?>" alt="">
                                            <?php } else { ?>
                                                <img class="w-100" src="<?php echo base_url('assets/images/articles/thumb_admin/download.png'); ?>" alt="">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $article['title'] ?></td>
                                        <td><?php echo $article['author'] ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($article['created_at'])) ?></td>
                                        <td><?php if ($article['status'] == 1) { ?>
                                                <p class="badge badge-success">Active</p>
                                            <?php } else { ?>
                                                <p class="badge badge-danger">Inactive</p>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url() . 'admin/article/edit/' . $article['id']; ?>" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0);" onclick="deleteArticle(<?php echo $article['id']; ?>)" class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt"></i></a>
                                        </td>

                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4">No Record Found..</td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div><?php echo $pagination_links ?></div>
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
    function deleteArticle(id) {
        if (confirm("Are you sure you want to delete the article?")) {
            window.location.href = '<?php echo base_url() . 'admin/article/delete/'; ?>' + id;
        }
    }
</script>