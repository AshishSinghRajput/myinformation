<div class="page-content__">

    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">
        <!-- Your Content Goes Here -->
        <link href="<?= base_url(); ?>assets/tree/tree-user/default.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="<?= base_url(); ?>assets/tree/tree-user/overlib.js"></script>

        <style>
            #tblTree a,
            #tblTree a:hover,
            #tblTree A:link,
            #tblTree A:visited,
            #tblTree A:active {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: bold;
                color: #990000;
                text-decoration: none;
            }

            .linkSpill {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 9px;
                color: Red;
            }

            .imgDsc {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 10px;
                font-weight: bold;
            }
        </style>

        <?php
        $CI = &get_instance();
        $data = $CI->gettreeview(sponsorid());
        // echo "<pre>";
        // print_r($data);
        // die;
        ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="widget flat radius-bordered">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <table cellpadding="0" cellspacing="1" width="100%" style="" class="mGrid">
                                    <tr class="hdr">
                                        <th align="center" valign="top" width="25%">
                                            <center>Member Types</center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/green.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">First Level</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">Second Level</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">Third Level</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/Label4.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">Fourth Level</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/Label5.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">Fifth Level</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" valign="top" width="25%">
                                            <img src="<?= base_url(); ?>assets/tree/tree-user/Label6.png" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span class="imgDsc">Sixth Level</span>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-sm-10">
                                <div id="ctl00_ContentPlaceHolder1_Panel1">

                                    <center>
                                        <table id="tblTree" style="width: 800px" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%" align="center" colspan="8" valign="top">
                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_imgMemberMain" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" />
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_linkM" class="tdcommonTree" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$linkM&quot;, &quot;&quot;, false, &quot;&quot;, &quot;/../Common/MemberRegistration3.aspx&quot;, false, true))"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data['name']);?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data['member_id'] ?><br /><?= ucfirst($data['name']);?></font>
                                                            </a></a>
                                                        <br /> &nbsp; &nbsp;
                                                        <br /> &nbsp;
                                                        <?php if((!empty($data['child_left'])) || (!empty($data['child_right']))) { ?>
                                                        <img id="ctl00_ContentPlaceHolder1_Image2" src="<?= base_url(); ?>assets/tree/tree-user/tree1.gif" style="width:416px;border-width:0px;" />
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php if((!empty($data['child_left'])) || (!empty($data['child_right']))) { ?>
                                                <tr>
                                                     <?php if(!empty($data['child_left'])) {
                                                      $data1 = $CI->gettreeview($data['child_left']); ?>
                                                    <td style="width: 50%" align="center" colspan="4" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a11">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember11" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl11" title="18456" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl11&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data1['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data1['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data1['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data1['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data1['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data1['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data1['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data1['name']);?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data1['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data1['member_id'] ?><br /><?= ucfirst($data1['name']);?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image4" src="<?= base_url(); ?>assets/tree/tree-user/tree2.gif" style="width:209px;border-width:0px;" />
                                                    </td>
                                                <?php }else{ ?>
                                                    <td style="width: 50%" align="center" colspan="4" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a11">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember11" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl11" title="18456" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl11&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni2');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image4" src="<?= base_url(); ?>assets/tree/tree-user/tree2.gif" style="width:209px;border-width:0px;" />
                                                    </td>
                                             
                                            
                                        <?php } ?>
                                         <?php if(!empty($data['child_right'])) {
                                                      $data2 = $CI->gettreeview($data['child_right']); ?>
                                                    <td style="width: 50%" align="center" colspan="4" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a12">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember12" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl12" title="18459" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl12&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data2['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data2['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data2['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data2['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data2['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data2['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data2['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data2['name']);?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data2['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data2['member_id'] ?><br /><?= ucfirst($data2['name']);?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image6" src="<?= base_url(); ?>assets/tree/tree-user/tree2.gif" style="border-width:0px;" />
                                                    </td>
                                                <?php }else{ ?>
                                                   <td style="width: 50%" align="center" colspan="4" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a12">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember12" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl12" title="18459" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl12&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni3');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                         <?php if((!empty($data1['child_left'])) || (!empty($data1['child_right']))) { ?>
                                                        <img id="ctl00_ContentPlaceHolder1_Image6" src="<?= base_url(); ?>assets/tree/tree-user/tree2.gif" style="border-width:0px;" />
                                                    <?php } ?>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                                 <?php if((!empty($data1['child_left'])) || (!empty($data1['child_right'])) || (!empty($data2['child_left'])) || (!empty($data2['child_right']))) { ?>
                                                <tr>
                                                     <?php if(!empty($data1['child_left'])) {
                                                      $data3 = $CI->gettreeview($data1['child_left']); ?>
                                                    <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a21">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember21" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl21" title="18522" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl21&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data3['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data3['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data3['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data3['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data3['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data3['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data3['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data3['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data3['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data3['member_id'] ?><br /><?= ucfirst($data3['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image8" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="width:116px;border-width:0px;" />
                                                    </td>
                                                <?php }else{ ?>
                                                    <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a21">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember21" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl21" title="18522" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl21&#39;,&#39;&#39;)"> <a  onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni4');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image8" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="width:116px;border-width:0px;" />
                                                    </td>
                                                <?php } ?>
                                                <?php if(!empty($data1['child_right'])) {
                                                      $data4 = $CI->gettreeview($data1['child_right']); ?>
                                                    <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a22">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember22" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl22" title="18523" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl22&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data4['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data4['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data4['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data4['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data4['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data4['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data4['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data4['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data4['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data4['member_id'] ?><br /><?= ucfirst($data4['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image10" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a22">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember22" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl22" title="18523" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl22&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni5');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                      
                                                        <img id="ctl00_ContentPlaceHolder1_Image10" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                
                                                    </td>

                                                    <?php } ?>
                                                      
                                                      <?php if(!empty($data2['child_left'])) {
                                                      $data5 = $CI->gettreeview($data2['child_left']); ?>
                                                    <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a23">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember23" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl23" title="18524" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl23&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data5['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data5['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data5['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data5['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data5['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data5['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data5['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : H<?= ucfirst($data5['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data5['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data5['member_id'] ?><br /><?= ucfirst($data5['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image12" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                    </td>
                                                    <?php }else{ ?>
                                                         <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a23">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember23" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl23" title="18524" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl23&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni6');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image12" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                    </td>
                                                    <?php } ?>
                                                    <?php if(!empty($data2['child_right'])) {
                                                      $data6 = $CI->gettreeview($data2['child_right']); ?>
                                                    <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a24">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember24" src="<?= base_url(); ?>assets/tree/tree-user/green.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl24" title="18529" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl24&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data6['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data6['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data6['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data6['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data6['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data6['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data6['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data6['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data6['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data6['member_id'] ?><br /><?= ucfirst($data6['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image14" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                    </td>
                                                    <?php }else{?>
                                                        <td style="width: 25%" align="center" colspan="2" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a24">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember24" src="<?= base_url(); ?>assets/tree/tree-user/green.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl24" title="18529" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl24&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Soni7');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <img id="ctl00_ContentPlaceHolder1_Image14" src="<?= base_url(); ?>assets/tree/tree-user/tree3.gif" style="border-width:0px;" />
                                                    </td>
                                                    <?php } ?>
                                              
                                                </tr>
                                              <?php if((!empty($data3['child_left'])) || (!empty($data3['child_right'])) || (!empty($data4['child_left'])) || (!empty($data4['child_right'])) || (!empty($data5['child_left'])) || (!empty($data5['child_right'])) || (!empty($data6['child_left'])) || (!empty($data6['child_right']))) { ?>
                                                <tr>
                                                      <?php if(!empty($data3['child_left'])) {
                                                      $data7 = $CI->gettreeview($data3['child_left']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a31">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember31" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl31" title="18816" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl31&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data7['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data7['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data7['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data7['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data7['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data7['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data7['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data7['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data7['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data7['member_id'] ?><br /><?= ucfirst($data7['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a31">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember31" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl31" title="18816" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl31&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('gattu 1');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                                    <?php if(!empty($data3['child_right'])) {
                                                      $data8 = $CI->gettreeview($data3['child_right']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a32">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember32" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl32" title="18904" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl32&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data8['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data8['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data8['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data8['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data8['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data8['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data8['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name :<?= ucfirst($data8['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data8['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data8['member_id'] ?><br /><?= ucfirst($data8['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a32">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember32" src="<?= base_url(); ?>assets/tree/tree-user/Label3.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl32" title="18904" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl32&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Dabi-1');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                                     <?php if(!empty($data4['child_left'])) {
                                                      $data9 = $CI->gettreeview($data4['child_left']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a33">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember33" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl33" title="19209" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl33&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data9['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data9['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data9['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data9['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data9['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data9['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data9['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data9['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data9['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data9['member_id'] ?><br /><?= ucfirst($data9['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a33">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember33" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl33" title="19209" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl33&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Malti-1');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                                      <?php if(!empty($data4['child_right'])) {
                                                      $data10 = $CI->gettreeview($data4['child_right']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a34">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember34" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl34" title="19238" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl34&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data10['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data10['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data10['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data10['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data10['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data10['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data10['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data10['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data10['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data10['member_id'] ?><br /><?= ucfirst($data10['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a34">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember34" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl34" title="19238" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl34&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('saiprasad');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                                   
                                                    <?php if(!empty($data5['child_left'])) {
                                                      $data11 = $CI->gettreeview($data5['child_left']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a35">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember35" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl35" title="20065" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl35&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data11['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data11['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data11['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data11['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data11['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data11['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data11['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data11['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data11['member_id'] ?>);">
                                                                <font class="Commonorangetext"><?= $data11['member_id'] ?><br /><?= ucfirst($data11['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a35">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember35" src="<?= base_url(); ?>assets/tree/tree-user/Label2.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl35" title="20065" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl35&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Dave-1');">
                                                                <font class="Commonorangetext">Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                                     <?php if(!empty($data5['child_right'])) {
                                                      $data12 = $CI->gettreeview($data5['child_right']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a36">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember36" src="<?= base_url(); ?>assets/tree/tree-user/green.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl36" title="20220" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl36&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data12['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data12['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data12['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data12['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data12['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data12['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data12['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data12['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data12['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data12['member_id'] ?><br /><?= ucfirst($data12['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a36">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember36" src="<?= base_url(); ?>assets/tree/tree-user/green.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl36" title="20220" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl36&#39;,&#39;&#39;)"> <a onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree('Patidar-1');">
                                                                <font class="Commonorangetext"> Null</font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php } ?>
                                               
                                                    <?php if(!empty($data6['child_left'])) {
                                                      $data13 = $CI->gettreeview($data6['child_left']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a37">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember37" src="<?= base_url(); ?>assets/tree/tree-user/black.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl36" title="20220" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl36&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data13['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data13['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data13['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data13['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data13['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data13['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data13['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data13['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data13['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data13['member_id'] ?><br /><?= ucfirst($data13['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>
                                                    <?php }else{ ?>
                                                        <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a37">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember37" src="<?= base_url(); ?>assets/tree/tree-user/black.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl37" class="tdcommonTree" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$Linkl37&quot;, &quot;&quot;, false, &quot;&quot;, &quot;/../Common/MemberRegistration3.aspx?SponsorID=Soni1&amp;&amp;reg=ht&quot;, false, true))">NUll</a>
                                                        <br /> &nbsp;

                                                        <br />
                                                    </td>

                                                    <?php } ?>
                                                    <?php if(!empty($data6['child_right'])) {
                                                      $data14 = $CI->gettreeview($data6['child_right']); ?>
                                                    <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a38">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember38" src="<?= base_url(); ?>assets/tree/tree-user/black.png" style="border-width:0px;" /></a>
                                                        <br />
                                                       <a id="ctl00_ContentPlaceHolder1_Linkl36" title="20220" class="tdcommonTree" href="javascript:__doPostBack(&#39;ctl00$ContentPlaceHolder1$Linkl36&#39;,&#39;&#39;)"> <a onmouseover='return overlib("<table cellpadding=1 cellspacing=1 border=0 class=mGridTreeView><tr><td align=left valign=top colspan=4><table width=100%><tr><td align=left><b>Member ID</b></td><td align=right><?= $data14['member_id'] ?></td></tr><tr><td align=left><b>Sponsor ID</b></td><td align=right><?= $data14['added_by'] ?></td></tr><tr><td align=left><b>Joining Date</b></td><td align=right><?= $data14['activation_date'] ?></td></tr><tr><td align=left><b>Total Left </b></td><td align=right><?= $data14['totalLeft'] ?></td></tr><tr><td align=left><b> Total Right</b></td><td align=right><?= $data14['totalRight'] ?></td></tr><tr><td align=left><b>Total Left Active </b></td><td align=right><?= $data14['leftActive'] ?></td></tr><tr><td align=left><b>Total Right Active </b></td><td align=right><?= $data14['rightActive'] ?></td></tr></table></td></tr></table>",CAPTION, "Member Name : <?= ucfirst($data14['name']) ?>")' onmouseout='return nd();' class='Commonorangetext' href="javascript:fViewTree(<?= $data14['member_id'] ?>);">
                                                                <font class="Commonorangetext"> <?= $data14['member_id'] ?><br /><?= ucfirst($data14['name']) ?></font>
                                                            </a></a>
                                                        <br /> &nbsp;
                                                         <br />

                                                    </td>
                                                <?php }else{ ?>
                                                 <td align="center" style="width: 12.5%" valign="top">
                                                        <a href="#" id="ctl00_ContentPlaceHolder1_a38">
                                                            <img id="ctl00_ContentPlaceHolder1_imgMember38" src="<?= base_url(); ?>assets/tree/tree-user/black.png" style="border-width:0px;" /></a>
                                                        <br />
                                                        <a id="ctl00_ContentPlaceHolder1_Linkl38" class="tdcommonTree" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$Linkl38&quot;, &quot;&quot;, false, &quot;&quot;, &quot;/../Common/MemberRegistration3.aspx?SponsorID=Soni1&amp;&amp;reg=ht&quot;, false, true))">Null</a>
                                                        <br /> &nbsp;

                                                        <br />
                                                        <br />

                                                    </td> 
                                                <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <?php } ?>
                                                 <?php } ?>
                                            </tbody>
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End of Your Content Goes Here -->
</div>