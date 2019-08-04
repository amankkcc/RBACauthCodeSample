<link href="<?php echo base_url() ?>css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/iEdit.css">
<style>
   .custom-scroll
   {
      height: 79vh !important;
      overflow-x: hidden;
   }
   .mrr2{
      margin-right:2px; 
   }

   select:required:invalid {
  color: gray;
}
option[value=""][disabled] {
  display: none;
}
option {
  color: black;
}
</style>
<!-----------content---------------------->
<div class="warper container-fluid">
   <!--end of row-->
   <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 bg-light-grey noprl">
         <div class="clearfix">
            <div class="col-md-4 col-sm-4 col-lg-4 noprl border-right">
               <div class="search-container">
                  <div class="row nomrl">
                     <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8 pdr0">
                        <div id="imaginary_container">
                           <div class="input-group stylish-input-group">
                              <input type="text" class="form-control" id="search"  placeholder="Search For Members">
                              <span class="input-group-addon">
                                 <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                     </div>
                    
                  </div>
               </div>
               <!--end--search-container-->
               <div id="demo">
                  <section id="examples">
                     <!-- content -->
                     <div id="content-3dtd" class="custom-scroll light">
                        <div class="panel-group mt20 bg-light-grey">
                           <?php
                           $sn = 1;
                           foreach ($orgs as $key => $value) {
                              ?>
                              <div class="panel panel-default">

                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                       <div class="row nomrl">
                                          <div class="col-md-11 col-sm-11 col-lg-11 col-xs-11 cursor-pointer" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $sn; ?>">
                                             <hr class="hr-blue">
                                             <span class="spantext alignright"><?php echo $value['org_name']; ?></span>
                                          </div>
                                          <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1 padding0">
                                             <a id="architect" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $sn; ?>"></a>
                                          </div>
                                       </div>
                                    </h4>
                                 </div>




                                 <div id="collapseOne<?php echo $sn; ?>" class="panel-collapse collapse in">
                                    <div class="panel-body ">

                                       <?php
                                                $m_sn = 1;
                                       foreach ($members as $keym => $valuem) {
                                          
                                          if ($valuem['org_id'] == $value['org_id']) {
                                             ?>

                                             <a href="#" onclick="show_members_details('<?php echo $valuem['user_id']; ?>')">
                                                <div class="border-left-green bg-white mt5b5 mrr2 mem-list">
                                                   <div class="row org_section mrr2 nomrl">
                                                      <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1 padding0"><span class="m-number"><span class="moveright"><?php echo $m_sn; ?></span></span></div>
                                                      <div id="mem_image<?php echo $valuem['user_id']; ?>" class="col-md-2 col-sm-2 col-lg-2 col-xs-2 search_img padding0"><img width="40" height="40" src="<?php if($valuem['path']){ echo base_url() . $valuem['path'] . '/' . $valuem['file_name']; }else{echo base_url() . "images" . '/' . "profil_icon.png";} ?>" class="img-circle"></div>
                                                      <div id="Org_name<?php echo $valuem['user_id']; ?>" class="col-md-5 col-sm-5 col-lg-5 col-xs-5 search_name noprl"><?php echo $valuem['first_name'] . ' ' . $valuem['last_name']; ?></div>
                                                      <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4 noprl search_desg padding0" id="search_desg<?php echo $value['org_id'] ?>"><?php echo $valuem['desg']; ?></div>
                                                   </div>
                                                   <!--end--row-->
                                                </div>
                                             </a>
                                             <?php

                                                $m_sn++; 
                                          }
                                          $sn++;

                                       }

                                       
                                       ?>
                                    </div>
                                 </div>
                              </div>

                              <!-- pannel div closed -->
                              <?php
                             
                           }
                           ?>


                        </div>
                        <!--end--panel -->
                     </div>
                     <!--end--content-3dtd-->
                  </section>
               </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-8">
               <div class="col-lg-10 col-md-10 col-sm-10">
                  <button id="bt_add_member"   class="member-add-btn mt10"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>

                  <button id="bt_edit_member" class="member-add-btn mt10">Edit</button>
                  <button data-toggle="modal" data-target="#delete_modal" id="btn_delete1" class="member-add-btn mt10">Delete</button>
               </div>
            </div>

            <div id="error_msg">
               <div class='text-danger'> <?php echo $error; ?></div><br>                      
               <div class='text-success'> <?php echo $msg; ?></div><br>      
            </div>

            <div id="add_member_form" class="col-md-7 col-sm-7 col-lg-7  bg-white dynamicData" style="overflow: auto; height: 500px;">

               <?php
               echo form_open_multipart('add_member/save_member');
               ?>
               <form action="" method="">

                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-lg-6 bg-white" >
                        <label class="rightposition" >Add New Member</label><br><br><br>

                         <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                           <input type="email" class="form-control heightinput email" id="i_email" name="email" placeholder="E-mail" required>
                        </div>

                        <div><input id="f_name" type="text" name="f_name" class="form-control heightinput" placeholder="First Name"></div>
                        <div><input id="l_name" type="text" name="l_name" class="form-control heightinput" placeholder="Last Name"></div>
                        <div><input type="text" name="designation" class="form-control heightinput" placeholder="Designation"></div>


                        <div class="form-group">
                           <select class="form-control heightinput" id="dropdown" name="org_id" required>
                              <option value="" hidden>Please Select Orgnization</option>
                              <?php foreach ($orgs as $key => $value) {
                                 ?>

                                 <option value="<?php echo $value['org_id']; ?>"><?php echo $value['org_name']; ?></option>

                              <?php }
                              ?>  

                           </select>
                        </div>


                       
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                           <input id="mobile" type="mobile" class="form-control heightinput contact_no" name="contact_no" placeholder="Contact No" required>
                        </div>
                        <div class="col-md-12"><br> <br><span class="contact_number" style="color:red;"></span></div>
                        <div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">
                        <br>
                           <button class="btn btn-success btn-right btn-add">
                              <i class="fa fa-check" aria-hidden="true"></i> ADD
                           </button>
                        </div>                      
                     </div>
                   <div class="  col-md-6 col-sm-6 col-lg-6 clr-gray">
                        <label for="mem_logo_file">
                           <div class="circle" id="mem_pic">
                              <center><i class=" fa fa-plus profileicon"><br>
                                    <span id="dataoffile" ><u>Profile Picture</u></span>
                                 </i></center>
                           </div>
                           <center></center>
                        </label>
                        <input class="hide" name="profile_pic"  id="mem_logo_file" type="file"/>
                     </div>

               </form>
</div>
            </div> <!-- end of col md 7 div -->

            <!-- ********** member details Edit ********* -->

            <div id="edit_member_form" class="col-md-7 col-sm-7 col-lg-7  bg-white dynamicData" style="overflow: auto; height: 500px;">

               <?php
               echo form_open_multipart('add_member/edit_member');
               ?>
               <form action="" method="">

                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-lg-6 bg-white" >
                        <label class="rightposition" >Edit Member</label><br><br><br>
                        <input id="users_id" type="hidden" name="users_id">
                        <div><input type="text" id="edit_f_name" name="edit_f_name" class="form-control heightinput" placeholder="First Name"></div>
                        <div><input type="text" id="edit_l_name" name="edit_l_name" class="form-control heightinput" placeholder="Last Name"></div>
                        <div><input type="text" id="edit_designation" name="edit_designation" class="form-control heightinput" placeholder="Designation"></div>


                        <div class="form-group">
                           <select class="form-control heightinput" id="edit_org_id" name="edit_org_id">
                              <option hidden>Orgnization</option>
                              <?php foreach ($orgs as $key => $value) {
                                 ?>

                                 <option value="<?php echo $value['org_id']; ?>"><?php echo $value['org_name']; ?></option>

                              <?php }
                              ?>  

                           </select>
                        </div>


                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                           <input type="text" class="form-control heightinput email"  id="edit_email" name="edit_email" placeholder="E-mail" required>
                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                           <input type="text" class="form-control heightinput edit_contact_no" id="edit_contact_no" name="edit_contact_no" placeholder="Contact No">
                        </div>

                        <div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">

                           <button class="btn btn-success btn-right btn-add">
                              <i class="fa fa-check" aria-hidden="true"></i> Update
                           </button>
                        </div>
                        <div class="col-md-12"><br> <br><span class="edit_contact" style="color:red;"></span></div>
                     </div>
                     <div class="  col-md-6 col-sm-6 col-lg-6 clr-gray">
                        <label for="edit_mem_logo_file">
                           <div class="circle" id="edit_mem_pic">
                              <center><i class=" fa fa-plus profileicon"><br>
                                    <span id="edit_dataoffile" ><u>Profile Picture</u></span>
                                 </i></center>
                           </div>
                           <center></center>
                        </label>
                        <input class="hide" name="profile_pic"  id="edit_mem_logo_file" type="file"/>
                     </div>

                  </div>

               </form>
            </div>
            <!-- ********** member details ********* -->

            <div id="member_details" class="col-xs-7 col-md-7 col-sm-7 col-lg-7  bg-white heightofpanel dynamicData" style="overflow: auto; height:400px;">
               <div class="member-detail-container friends">

                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4"><label id="orgname" class="mt15">Member Name</label></div>
                     <!--end-col-3-->
                     <div class="col-md-1 col-sm-1 col-lg-1 pdr0">
                        <img width="40" height="40" id="profile_pic" src="" class="img-circle member-img">
                     </div>
                     <!--end-col-2-->
                     <div class="col-md-7 col-sm-7 col-lg-7">
                        <p id="name" class="mt15">xyz sharma</p>
                     </div>
                     <!--end-col-7-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="">Organisation</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <p id="org_name">&nbsp;&nbsp;org name</p>
                     </div>
                     <!--end-col-7-->
                  </div>

                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="">Designation</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <p id="desg">&nbsp;&nbsp;desg</p>
                     </div>
                     <!--end-col-7-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="">Contact Details</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <div class="mt10"><i class="fa fa-envelope-o" aria-hidden="true"></i><label class="pdl8" id="email"></label> </div>
                        <div class="mt10"><i class="fa fa-phone" aria-hidden="true"></i><label class="pdl8" id="phone"></label> </div>  
                     </div>
                     <!--end-col-9-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30" style="display:none;">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="mt15">Projects Handled</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-4 col-sm-4 col-lg-4 pdr0 pdl10">
                        <a href="javascript:void(0)">
                           <img src="images/project-1.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-2.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-3.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-4.png" class="img-circle img-responsive project-handle-img">
                        </a>
                     </div>
                     <!--end-col-7-->
                     <div class="col-md-3 col-sm-3 col-lg-3 noprl">
                        <p class="more15 mt15"><a href="javascript:void(0)">& 15 more</a></p>
                     </div>
                     <!--end-col-2-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                  </div>
                  <div class="row mt30">
                  </div>
                  <div class="row mt30">
                     <div align="bottom" class="col-md-4 col-sm-4 col-lg-4">
                        <p class="positionofdate">Added on</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <p id="created" class="">17 Aug. 2016</p>
                     </div>
                     <!--end-col-9-->
                  </div>
                  <!--end--row-->
               </div>
               <!-- ****** end member details ********* -->


            </div>
         </div>
      </div>
   </div>
</div>
<!-- ======================================== Delete  Modal ============================================= -->
<div class="modal fade" id="delete_modal" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <h2>Are you sure you wont to delete </h2>
         </div>
         <div class="modal-footer">
            <button id="btn_delete" type="button" class="btn btn-default" data-dismiss="modal">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>

   </div>
</div>



<!-- Loading state -->

<script src="<?php echo base_url() ?>js/jquery-3.1.1.min.js?v=1.0"></script>
 <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>
<script src="<?php echo base_url() ?>js/add_member.js?v=1.0" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/members_list.js?v=1.0"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/iEdit.js?v=1.0"></script>
<!--end--member-detail-container-->


