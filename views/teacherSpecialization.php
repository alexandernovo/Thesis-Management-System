<?php
require_once("./teacherNavbar.php");
$specialization = find_where('specialization', ['teacher_ID' => $_SESSION['teacher_ID']]);
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex mb-3 justify-content-between mx-4 align-items-center">
                    <h6><i class="fa fa-tools"></i> Specialization</h6>
                    <button class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSpecial"><i class="fa fa-plus-circle text-size me-1"></i> Specialization</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Specialization</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($specialization as $row) : ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?php echo $no;
                                                                                            $no++; ?></p>
                                        </td>

                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['Specialization_name'] ?></p>
                                        </td>
                                        <td><i class="fa fa-edit text-size text-success cursor-pointer" data-bs-toggle="modal" data-bs-target="#editSpecial<?= $row['Specialization_ID'] ?>"></i></td>
                                        <td><a href="../actions/teacherSpecialization.php?deleteSpecial&specialization_ID=<?= $row['Specialization_ID'] ?>"><i class="fa fa-trash  text-size text-danger"></i></a></td>
                                    </tr>

                                    <div class="modal fade" id="editSpecial<?= $row['Specialization_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Specialization</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/teacherSpecialization.php">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Specialization</label>
                                                            <input class="form-control" value="<?= $row['Specialization_name'] ?>" name="specialization">
                                                            <input type="hidden" value="<?= $row['Specialization_ID'] ?>" name="specialization_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                        <button type="submit" class="btn btn-primary" name="updateSpecial"><i class="fa fa-check"></i> Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSpecial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Specialization</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../actions/teacherSpecialization.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Specialization</label>
                        <input class="form-control" placeholder="Specialization" name="specialization">
                        <input type="hidden" value="<?php echo $_SESSION['teacher_ID'] ?>" name="teacher_ID">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary" name="addSpecial"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>