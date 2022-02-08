
<div class="row">
    <h1 class="page-header">Slides</h1>
    <div class="col-xs-12 col-md-3">
        <?php display_message(); ?>
        <form action="" method="post" enctype="multipart/form-data">
            <?php add_banner(); ?>
            <div class="form-group">
                <input type="file" name="banner" class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Slide Title</label>
                <input type="text" name="banner_title" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="add_banner" class="btn btn-info">
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-md-8">
        <?php get_current_banner_in_admin();?>
    </div>
</div>
<hr>
    <div class="row">
        <h1 class="page-header">Slides Available</h1>
        <?php get_banner_thumbnails_to_admin(); ?>
    </div>
