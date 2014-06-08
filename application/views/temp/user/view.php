<div class='row'>
    <?php
    if ($this->session->flashdata('msg')) {
        ?>
        <script>
            $(document).ready(function() {
                $('#myModal').modal('show');
            });
        </script>
        <?php
    }
    ?>
    <div class="text-center">
        <h3><i class="icon icon-user"></i> ইউজার এর বিস্তারিত তথ্য</h3>
    </div>
    <?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success alert-block fade in">
            <button class="close close-sm" type="button" data-dismiss="alert">
                <i class="icon-remove"></i>
            </button>
            <h4>
                <i class="icon-ok-sign"></i>
                Success!
            </h4>
            <p><?php echo $this->session->flashdata('msg'); ?></p>
        </div>
    <?php } ?>
    <div class='col-lg-12'>
        <section class="panel panel-body">
            <div class="panel panel-primary">
                <header class="panel-heading">
                    <h4>ইউজার এর বিস্তারিত তথ্যসমূহ</h4>
                </header>
                <a href="<?php echo site_url('con_set_user/create'); ?>" class="btn btn-info btn-sm" name="create" id="create"><i class="icon icon-plus"></i> নতুন ইউজার তৈরি করুন</a>
                <div class="panel-body">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead> 
                            <tr class="active">
                                <th><i class="icon icon-picture"></i> ছবি</th>
                                <th><i class="icon icon-edit"></i> নাম</th>
                                <th><i class="icon icon-user"></i> ইউজার নাম</th>
                                <th><i class="icon icon-envelope"></i> ইমেল</th>
                                <th><i class="icon icon-user-md"></i> ভূমিকা</th>
                                <th><i class="icon icon-rocket"></i> প্রক্রিয়া</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->load->helper('html');
                            if (isset($tbl_user)) {
                                foreach ($tbl_user as $rec_user) {
                                    $image_properties = array(
                                        'src' => 'img/' . $rec_user->Image,
                                        'alt' => 'Cant upload image ',
                                        'class' => 'post_images',
                                        'width' => '45',
                                        'height' => '45',
                                        'title' => 'That was quite a night',
                                        'rel' => 'lightbox',
                                    );
                                    ?>
                                    <tr>
                                        <td class="hidden-phone"><?php echo img($image_properties); ?></td>
                                        <td><?php echo $rec_user->FirstName . " " . $rec_user->MiddleName . " " . $rec_user->LastName; ?> </td> 
                                        <td><?php echo $rec_user->UserName; ?> </td>                        
                                        <td><?php echo $rec_user->Email; ?> </td>
                                        <td><?php echo $rec_user->Role; ?> </td> 
                                        <td>
                                            <a href="<?php echo base_url(); ?>con_set_user/edit/<?php echo $rec_user->ID; ?>" class="btn btn-info btn-xs" title="সংশোধন করুন"><i class="icon icon-pencil"></i> সংশোধন করুন</a>
                                            <a href="<?php echo base_url(); ?>con_set_user/delete/<?php echo $rec_user->ID; ?>" class="btn btn-danger btn-xs" title="মুছুন" onclick="return confirm('আপনি কি নিশ্চিত যে এই তথ্যটি মুছে ফেলতে চান?')"><i class="icon icon-trash"></i> মুছুন</a>
                                        </td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                        </tbody>            
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
