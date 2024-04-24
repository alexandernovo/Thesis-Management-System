<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php"); ?>
<div class="container-fluid py-4 mb-5">
    <div class="row mx-auto">
        <div class="col-md-8">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex justify-content-between mx-3">
                    <h6>Manage Specialization</h6>
                    <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addspecialization"><i class="fa fa-plus-circle me-1 text-size"></i> Specialization</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3 mt-3">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Specialization</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = findAll('specialization');
                                $no = 1;
                                foreach ($row as $result) :
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0 "><?php echo $no;
                                                                                            $no++; ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0 "><?= $result['Specialization_name'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <a class="text-secondary font-weight-bold text-xs cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit_spec<?= $result['Specialization_ID'] ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a class="text-danger font-weight-bold text-xs cursor-pointer">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_spec<?= $result['Specialization_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Specialization</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="../actions/manageSpecialization.php">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Specialization</label>
                                                                <input type="hidden" name="Specialization_ID" value="<?= $result['Specialization_ID'] ?>">
                                                                <input class="form-control" value="<?= $result['Specialization_name'] ?>" placeholder="Specialization" name="specialization" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                            <button type="submit" class="btn btn-primary" name="update_specialization"><i class="fa fa-plus-circle"></i> Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addspecialization" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Specialization</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageSpecialization.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Specialization</label>
                            <input class="form-control" placeholder="Specialization" name="specialization" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" name="add_specialization"><i class="fa fa-plus-circle"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("./footer.php"); ?>