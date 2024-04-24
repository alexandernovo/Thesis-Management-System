<?php
require_once("./studentNavbar.php");
?>
<div class="container-fluid py-4">
    <div class="row mx-auto">
        <div class="offset-md-8 col-md-4">
            <div class="form-group">
                <div class="d-flex align-items-center">
                    <label class="m-0 me-2">Search:</label>
                    <div class="d-flex align-items-center position-relative" style="width: 100%;">
                        <i class="fa fa-search position-absolute ms-2 border-end pe-1 bg-white"></i>
                        <input type="search" id="searchadviser" class="form-control form-control-sm text-indent" placeholder="Search something...">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-auto mt-3" id="adviser">
    </div>
</div>
<?php require_once("./footer.php"); ?>