<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("user/add");
$can_edit = ACL::is_allowed("user/edit");
$can_view = ACL::is_allowed("user/view");
$can_delete = ACL::is_allowed("user/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">My Account</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_user']) ? urlencode($data['id_user']) : null);
                        $counter++;
                        ?>
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <?php 
                                    if(!empty(USER_PHOTO)){
                                    Html::page_img(USER_PHOTO, 100, 100); 
                                    }
                                    ?>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['email']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="fa fa-user"></i> Account Detail
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="fa fa-edit"></i> Edit Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangeEmail" class="nav-link">
                                                <i class="fa fa-envelope"></i> Change Email
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="fa fa-key"></i> Reset Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <table class="table table-hover table-borderless table-striped">
                                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <tr  class="td-nama">
                                                        <th class="title"> Nama: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="nama" 
                                                                data-title="Masukan Nama" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['nama']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-jenis_kelamin">
                                                        <th class="title"> Jenis Kelamin: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $jenis_kelamin); ?>' 
                                                                data-value="<?php echo $data['jenis_kelamin']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="jenis_kelamin" 
                                                                data-title="Enter Jenis Kelamin" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="radiolist" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['jenis_kelamin']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-tahun_lulus">
                                                        <th class="title"> Tahun Lulus: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/account_tahun_lulus_option_list'); ?>' 
                                                                data-value="<?php echo $data['tahun_lulus']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="tahun_lulus" 
                                                                data-title="Masukan Tahun Lulus" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['tahun_lulus']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-jurusan">
                                                        <th class="title"> Jurusan: </th>
                                                        <td class="value">
                                                            <a size="sm" class="btn btn-white page-modal" href="<?php print_link("jurusan/list/id_jurusan/" . urlencode($data['jurusan'])) ?>">
                                                                <?php echo $data['jurusan_jurusan'] ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-email">
                                                        <th class="title"> Email: </th>
                                                        <td class="value"> <?php echo $data['email']; ?></td>
                                                    </tr>
                                                    <tr  class="td-no_telepon">
                                                        <th class="title"> No Telepon: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_telepon']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="no_telepon" 
                                                                data-title="Masukan No Telepon" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['no_telepon']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-alamat">
                                                        <th class="title"> Alamat: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="alamat" 
                                                                data-title="Masukan Alamat" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['alamat']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-pekerjaan_saat_ini">
                                                        <th class="title"> Pekerjaan Saat Ini: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $pekerjaan_saat_ini); ?>' 
                                                                data-value="<?php echo $data['pekerjaan_saat_ini']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="pekerjaan_saat_ini" 
                                                                data-title="Pilih Pekerjaan Saat Ini" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="select" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['pekerjaan_saat_ini']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-account_status">
                                                        <th class="title"> Account Status: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $account_status); ?>' 
                                                                data-value="<?php echo $data['account_status']; ?>" 
                                                                data-pk="<?php echo $data['id_user'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id_user'])); ?>" 
                                                                data-name="account_status" 
                                                                data-title="Pilih Status Akun" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="select" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['account_status']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>    
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/edit"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane  fade" id="AccountPageChangeEmail" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/change_email"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("passwordmanager"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="fa fa-ban"></i> No Record Found
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
