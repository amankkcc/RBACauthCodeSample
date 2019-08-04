
<style>
   .add_role_tbl .fa-check-circle-o{
      color:#D3d3d3; 
   }
   .add_role_tbl td,.add_role_tbl th,.view-role-tbl td,.view-role-tbl th{
      text-align: center;
   }
   .nomrl{
      margin-left: 0px;
      margin-right: 0px;
   }
   .custom-scroll
   {
      height: 79vh !important;
      overflow-x: hidden;
   }
</style>
<div class="warper container-fluid">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 noprl">
         <div class="bg-light-grey clearfix">
            <div class="col-md-4 col-sm-4 col-lg-4 noprl border-right">
               <div class="search-container">
                  <div class="row nomrl">
                     <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8 pdr0">
                        <div id="imaginary_container">
                           <div class="input-group stylish-input-group">
                              <input id="search" type="text" class="form-control"  placeholder="Search For Role">
                              <span class="input-group-addon">
                                 <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4" >
                        
                     </div>
                  </div>
               </div>
               <!--end--search-container-->
               <div id="demo">
                  <section id="examples">
                     <!-- content -->
                     <div id="content-3dtd" class="custom-scroll light">
                        <div class="panel-group mt20" id="">
                           <div class="panel-body">
                              <div class="mt5b5 mem-list">

                                 <?php
                                 $s = 1;
                                 foreach ($roles as $key => $value) {
                                    $role_id = (string) $value['role_id'];
                                    ?>
                                    <a href="#" onclick="show_roles_details(<?php echo $role_id; ?>)">
                                       <div id="num_rols" class="row border-left-green bg-white nomrl num_rols" style="margin-top: 2px;">
                                          <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1 num_rols padding0"><span class="m-number"><?php echo $s; ?></span></div>
                                          
                                          <div id="roll_name" class="roll_name col-md-11 col-sm-11 col-lg-11 col-xs-11"><?php echo $value['role_name'] ?></div>
                                       </div>
                                       <!--end--row-->
                                    </a>


                                    <?php $s++;
                                 }
                                 ?>
                              </div>
                              <br><br><br><br>
                           </div>
                        </div>
                     </div>
                     <!--end--content-3dtd-->
                  </section>
               </div>
               <!--end--of--id-demo-->
            </div>
            <!--end--col-4-->
            <div class="col-md-8 col-sm-8 col-lg-8">

               <div class="box-role">
                  <div class="container" id="main_add_role_btn">
                     <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                           <a href="#" onclick="show_roles_section()"><button  align="left"  value="Submit" id="btnSubmit" name="btnSubmit" class="member-add-btn mt10"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button></a>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3" style="margin-top:10px;">
                        </div>
                     </div>
                  </div>

               <div id="role_access_tb">
                     <form action="<?php echo base_url(); ?>add_roles/roles_save" method="post">
                        <div class="container">
                           <div class="row" style="margin-left:20px;">
                              <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                 <input required="" name="role_title" type="text" class="form-control"  placeholder="Role-Ttile" style="border-radius:10px;"><br>
                              </div>
                              <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                              <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                    <button type="submit"  align="left" class="member-add-btn mt10" style="background-color: green;"><i class="fa fa-plus" aria-hidden="true"></i> Create-New</button>
                              </div>
                           </div>
                        </div>
                        <div class="row" style=" overflow:auto; height:450px; padding-left:20px; padding-right:20px;">
                           <table border="0" class="table scroll add_role_tbl">
                              <thead>
                                 <tr  class="header">
                                    <th colspan="1" data-toggle="" data-target="" class="openmodal"></th>
                                    <th class="view"><i class="fa fa-eye" aria-hidden="true"></i>View</th>
                                    <th class="edit"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</th>
                                    <th class="approve"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Approve</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="">
                                    <td >Schedule</td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk1" type="checkbox" name="schedule_v" value="<?php echo $perms[0]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>                  
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk2" type="checkbox" name="schedule_e" value="<?php echo $perms[1]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk3" type="checkbox" name="schedule_a" value="<?php echo $perms[2]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>

                                 <tr class="/">
                                    <td>Resources</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk1" type="checkbox" name="resources_v" value="<?php echo $perms[3]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk2" type="checkbox" name="resources_e" value="<?php echo $perms[4]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input class="chk3" type="checkbox" name="resources_a" value="<?php echo $perms[5]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Drawings</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="drawings_v" value="<?php echo $perms[12]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="drawings_e"  value="<?php echo $perms[13]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="drawings_a" value="<?php echo $perms[14]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >BOQ</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="boq_v" value="<?php echo $perms[15]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="boq_e" value="<?php echo $perms[16]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="boq_a" value="<?php echo $perms[17]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Site Images</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="site_images_v" value="<?php echo $perms[18]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="site_images_e" value="<?php echo $perms[19]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="site_images_a" value="<?php echo $perms[20]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >MOM</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="mom_v" value="<?php echo $perms[21]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="mom_e" value="<?php echo $perms[22]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="mom_a" value="<?php echo $perms[23]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Quality</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="quality_v" value="<?php echo $perms[24]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="quality_e" value="<?php echo $perms[25]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="quality_a" value="<?php echo $perms[26]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Safety</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="safety_v" value="<?php echo $perms[27]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="safety_e" value="<?php echo $perms[28]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="safety_a" value="<?php echo $perms[29]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Measurement</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="measurement_v" value="<?php echo $perms[30]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="measurement_e" value="<?php echo $perms[31]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="measurement_a" value="<?php echo $perms[32]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Billing</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="billing_v" value="<?php echo $perms[33]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="billing_e" value="<?php echo $perms[34]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input type="checkbox" name="billing_a" value="<?php echo $perms[35]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </form>
                  </div>

                  <div id="edit_role_tb">
                     <form action="<?php echo base_url(); ?>add_roles/update_roles_data" method="post">
                        <div class="container">
                           <div class="row" style="margin-left:20px;">
                              <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                 <input required="" name="role_title" type="text" class="form-control"  placeholder="Role-Ttile" style="border-radius:10px;" id="edit_role_tb_name"><br>
                                 <input required="" name="role_id" type="hidden" class="form-control"  placeholder="Role-Ttile" style="border-radius:10px;" id="edit_role_tb_id"><br>
                              </div>
                              <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                              <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                    <button type="submit"  align="left" class="member-add-btn mt10" style="background-color: green;"><i class="fa fa-plus" aria-hidden="true"></i> Update-Role</button>
                              </div>
                           </div>
                        </div>
                        <div class="row" style=" overflow:auto; height:450px; padding-left:20px; padding-right:20px;">
                           <table border="0" class="table scroll add_role_tbl">
                              <thead>
                                 <tr  class="header">
                                    <th colspan="1" data-toggle="modal" data-target="#myModal" class="openmodal"><span><i class="fa fa-arrows-alt fa-1x" aria-hidden="true"></i></span></th>
                                    <th class="view"><i class="fa fa-eye" aria-hidden="true"></i>View</th>
                                    <th class="edit"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</th>
                                    <th class="approve"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Approve</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="">
                                    <td >Schedule</td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e1" type="checkbox" name="schedule_v" value="<?php echo $perms[0]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>                  
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e2" type="checkbox" name="schedule_e" value="<?php echo $perms[1]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e3" type="checkbox" name="schedule_a" value="<?php echo $perms[2]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>

                                 <tr class="/">
                                    <td>Resources</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e4" type="checkbox" name="resources_v" value="<?php echo $perms[3]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e5" type="checkbox" name="resources_e" value="<?php echo $perms[4]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td >
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e6" type="checkbox" name="resources_a" value="<?php echo $perms[5]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Drawings</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e13" type="checkbox" name="drawings_v" value="<?php echo $perms[12]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e14" type="checkbox" name="drawings_e"  value="<?php echo $perms[13]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e15" type="checkbox" name="drawings_a" value="<?php echo $perms[14]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >BOQ</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e16" type="checkbox" name="boq_v" value="<?php echo $perms[15]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e17" type="checkbox" name="boq_e" value="<?php echo $perms[16]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e18" type="checkbox" name="boq_a" value="<?php echo $perms[17]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Site Images</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e19" type="checkbox" name="site_images_v" value="<?php echo $perms[18]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e20" type="checkbox" name="site_images_e" value="<?php echo $perms[19]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e21" type="checkbox" name="site_images_a" value="<?php echo $perms[20]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >MOM</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e22" type="checkbox" name="mom_v" value="<?php echo $perms[21]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e23" type="checkbox" name="mom_e" value="<?php echo $perms[22]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e24" type="checkbox" name="mom_a" value="<?php echo $perms[23]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Quality</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e25" type="checkbox" name="quality_v" value="<?php echo $perms[24]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e26" type="checkbox" name="quality_e" value="<?php echo $perms[25]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e27" type="checkbox" name="quality_a" value="<?php echo $perms[26]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Safety</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e28" type="checkbox" name="safety_v" value="<?php echo $perms[27]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e29" type="checkbox" name="safety_e" value="<?php echo $perms[28]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e30" type="checkbox" name="safety_a" value="<?php echo $perms[29]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Measurement</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e31" type="checkbox" name="measurement_v" value="<?php echo $perms[30]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e32" type="checkbox" name="measurement_e" value="<?php echo $perms[31]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e33" type="checkbox" name="measurement_a" value="<?php echo $perms[32]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr class="">
                                    <td >Billing</td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e34" type="checkbox" name="billing_v" value="<?php echo $perms[33]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e35" type="checkbox" name="billing_e" value="<?php echo $perms[34]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="checkbox">
                                          <label class="checkbox-bootstrap checkbox-lg">                           
                                             <input id="e36" type="checkbox" name="billing_a" value="<?php echo $perms[35]['perm_id'] ?>">             
                                             <span class="checkbox-placeholder"></span>           
                                          </label>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </form>
                  </div>

                  <div id="role_view_tb">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                              <a href="#" onclick="show_roles_section()"><button  align="left"  value="Submit" id="btnSubmit" name="btnSubmit" class="member-add-btn mt10"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button></a>
                              <a href="#" data-toggle="modal" data-target="#edit_role_modal">
                                <button  align="left" class="member-add-btn mt10">Edit</button>
                              </a>
                              <a href="#" data-toggle="modal" data-target="#delete_modal">
                                 <button  align="left" class="member-add-btn mt10 deleteRow">Delete</button>
                              </a>
                           </div>
                           <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2" style="margin-top:10px;">
                              
                           </div>
                        </div>
                     </div>
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">

                           </div>
                           <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3" style="margin-top:10px;">
                              
                           </div>
                        </div>
                     </div>
                     <div class="container">
                        <div class="row roleInfo" style="margin-left:20px;">
                           <div class="col-sm-3 col-md-3 col-lg-1 col-xs-2">
                              <h6 class="text-bottom">Role Title</h6>
                           </div>
                           <div class="col-sm-4 col-md-4 col-lg-2 col-xs-2" >
                              <strong><h6 style="font-weight: bold;" id="role_name" class="text-bottom roletitle" align="left"></h6></strong>
                           </div>
                           <div class="col-sm-3 col-md-3 col-lg-2 col-xs-2 text-center">
                              <h6 class="text-bottom">Created on</h6>
                           </div>
                           <div class="col-sm-5 col-md-5 col-lg-1 col-xs-2">
                              <strong><h6 style="font-weight: bold;" class="text-bottom" id="added_on">&nbsp;<span style="float:right"><a ><i class="fa fa-trash deleteRow" aria-hidden="true" ></i></a>&nbsp;&nbsp;<a href="#"><i class="fa fa-pencil side-pencil" aria-hidden="true"></i></a></span></h6></strong>
                           </div>
                        </div>
                     </div>

                     <div class="row role_sec" style=" overflow:auto; height:450px; padding-left:20px; padding-right:20px;">
                        <table border="0" class="table scroll view-role-tbl" >
                           <thead>
                              <tr class="header">
                                 <th colspan="1" data-toggle="modal" data-target="#myModal1" class="openmodal"></th>
                                 <th class="view"><i class="fa fa-eye" aria-hidden="true"></i> View</th>
                                 <th class="edit"><i class="fa fa-pencil edit-pencil" aria-hidden="true"></i > Edit</th>
                                 <th class="approve"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Schedule</td>
                                 <td id="1"></td>
                                 <td id="2"></td>
                                 <td id="3"></td>
                              </tr>
                              <tr>
                                 <td>Resources</td>
                                 <td id="4"></td>
                                 <td id="5"></td>
                                 <td id="6"></td>
                              </tr>
                              <tr>
                                 <td >Drawings</td>
                                 <td id="13"></td>
                                 <td id="14"></td>
                                 <td id="15"></td>
                              </tr>
                              <tr>
                                 <td >BOQ</td>
                                 <td id="16"></td>
                                 <td id="17"></td>
                                 <td id="18"></td>
                              </tr>
                              <tr>
                                 <td >Site Images</td>
                                 <td id="19"></td>
                                 <td id="20"></td>
                                 <td id="21"></td>
                              </tr>
                              <tr>
                                 <td >MOM</td>
                                 <td id="22"></td>
                                 <td id="23"></td>
                                 <td id="24"></td>
                              </tr>
                              <tr>
                                 <td >Quality</td>
                                 <td id="25"></td>
                                 <td id="26"></td>
                                 <td id="27"></td>
                              </tr>
                              <tr>
                                 <td >Safety</td>
                                 <td id="28"></td>
                                 <td id="29"></td>
                                 <td id="30"></td>
                              </tr>
                              <tr>
                                 <td >Measurement</td>
                                 <td id="31"></td>
                                 <td id="32"></td>
                                 <td id="33"></td>
                              </tr>
                              <tr>
                                 <td >Billing</td>
                                 <td id="34"></td>
                                 <td id="35"></td>
                                 <td id="36"></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>


               </div>
            </div><!--end col-md-7 -->
         </div><!--end of bg-light-grey clearfix-->
      </div><!--end of col-md-12 part -->
   </div><!--end of row-->
</div><!--end Wrapper-->


            
            <!--end of modal code-->






 <!-- ======================================== Delete  Modal ============================================= -->
            <div class="modal fade" id="delete_modal" role="dialog">
               <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-body">
                        <input type="" name="role_id" id="del_role_id" hidden>
                        <h2>Are you sure you want to delete </h2>
                     </div>
                     <div class="modal-footer">
                        <button  id="btn_delete_role" type="button" class="btn btn-default" data-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     </div>
                  </div>

               </div>
            </div>


            <!-- ======================================== Edit role  Modal ============================================= -->
            <div class="modal fade" id="edit_role_modal" role="dialog">
               <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-body">
                     <input type="hidden" name="role_id" id="edit_role_id">
                        <h2>Are you sure you want to edit </h2>
                     </div>
                     <div class="modal-footer">
                        <button id="bt_edit_role" type="button" class="btn btn-default" data-dismiss="modal">Edit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     </div>
                  </div>

               </div>
            </div>







            


             <!-- The Modal expend code -->
                        <div id="myModal" class="modal fade" role="dialog">
                           <div class="modal-dialog modal-lg">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modaltitle"></h4>
                                 </div>
                                 <div class="modal-body" id="modalBody">
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>

<script type="text/javascript" src="<?php echo base_url() ?>js/add_roles.js?v=1.0"></script>
<script type="text/javascript">

$("input[name='schedule_e'], input[name='schedule_a']").click(function () {
    if ($("input[name='schedule_e']").is(':checked') == true || $("input[name='schedule_a']").is(':checked') == true) {
        $("input[name='schedule_v']").prop('checked',this.checked);
    }

    if ($("input[name='schedule_a']").is(':checked') == true) {
        $("input[name='schedule_e']").prop('checked',this.checked);
        $("input[name='schedule_v']").prop('checked',this.checked);
    }

    //else{
     //    $("input[name='schedule_e']").prop('checked',false);
      //   $("input[name='schedule_v']").prop('checked',false);
    //}
});
$("input[name='resources_e'], input[name='resources_a']").click(function () {
    if ($("input[name='resources_e']").is(':checked') == true || $("input[name='resources_a']").is(':checked') == true) {
        $("input[name='resources_v']").prop('checked',this.checked);
    }

    if ($("input[name='resources_a']").is(':checked') == true) {
        $("input[name='resources_e']").prop('checked',this.checked);
        $("input[name='resources_v']").prop('checked',this.checked);
    }


});
$("input[name='drawings_e'], input[name='drawings_a']").click(function () {
    if ($("input[name='drawings_e']").is(':checked') == true || $("input[name='drawings_a']").is(':checked') == true) {
        $("input[name='drawings_v']").prop('checked',this.checked);
    }

    if ($("input[name='drawings_a']").is(':checked') == true) {
        $("input[name='drawings_e']").prop('checked',this.checked);
        $("input[name='drawings_v']").prop('checked',this.checked);
    }
});
$("input[name='boq_e'], input[name='boq_a']").click(function () {
    if ($("input[name='boq_e']").is(':checked') == true || $("input[name='boq_a']").is(':checked') == true) {
        $("input[name='boq_v']").prop('checked',this.checked);
    }

    if ($("input[name='boq_a']").is(':checked') == true) {
        $("input[name='boq_e']").prop('checked',this.checked);
        $("input[name='boq_v']").prop('checked',this.checked);
    }
});
$("input[name='site_images_e'], input[name='site_images_a']").click(function () {
    if ($("input[name='site_images_e']").is(':checked') == true || $("input[name='site_images_a']").is(':checked') == true) {
        $("input[name='site_images_v']").prop('checked',this.checked);
    }

    if ($("input[name='site_images_a']").is(':checked') == true) {
        $("input[name='site_images_e']").prop('checked',this.checked);
        $("input[name='site_images_v']").prop('checked',this.checked);
    }
});
$("input[name='mom_e'], input[name='mom_a']").click(function () {
    if ($("input[name='mom_e']").is(':checked') == true || $("input[name='mom_a']").is(':checked') == true) {
        $("input[name='mom_v']").prop('checked',this.checked);
    }

    if ($("input[name='mom_a']").is(':checked') == true) {
        $("input[name='mom_e']").prop('checked',this.checked);
        $("input[name='mom_v']").prop('checked',this.checked);
    }

});
$("input[name='quality_e'], input[name='quality_a']").click(function () {
    if ($("input[name='quality_e']").is(':checked') == true || $("input[name='quality_a']").is(':checked') == true) {
        $("input[name='quality_v']").prop('checked',this.checked);
    }

    if ($("input[name='quality_a']").is(':checked') == true) {
        $("input[name='quality_e']").prop('checked',this.checked);
        $("input[name='quality_v']").prop('checked',this.checked);
    }
});
$("input[name='safety_e'], input[name='safety_a']").click(function () {
    if ($("input[name='safety_e']").is(':checked') == true || $("input[name='safety_a']").is(':checked') == true) {
        $("input[name='safety_v']").prop('checked',this.checked);
    }

    if ($("input[name='safety_a']").is(':checked') == true) {
        $("input[name='safety_e']").prop('checked',this.checked);
        $("input[name='safety_v']").prop('checked',this.checked);
    }
});
$("input[name='measurement_e'], input[name='measurement_a']").click(function () {
    if ($("input[name='measurement_e']").is(':checked') == true || $("input[name='measurement_a']").is(':checked') == true) {
        $("input[name='measurement_v']").prop('checked',this.checked);
    }
    if ($("input[name='measurement_a']").is(':checked') == true) {
        $("input[name='measurement_e']").prop('checked',this.checked);
        $("input[name='measurement_v']").prop('checked',this.checked);
    }
});
$("input[name='billing_e'], input[name='billing_a']").click(function () {
    if ($("input[name='billing_e']").is(':checked') == true || $("input[name='billing_a']").is(':checked') == true) {
        $("input[name='billing_v']").prop('checked',this.checked);
    }

    if ($("input[name='billing_a']").is(':checked') == true) {
        $("input[name='billing_e']").prop('checked',this.checked);
        $("input[name='billing_v']").prop('checked',this.checked);
    }
});
</script>