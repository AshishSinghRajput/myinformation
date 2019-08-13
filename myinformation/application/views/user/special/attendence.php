<?php $this->load->view('Admin/header');?>
<?php $this->load->view('Admin/sidebar');?>
<div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
									
                                </div>
                                <div class="">
                                	<table class="table table-striped" id="datatable-editable">
	                                    <thead>
	                                        <tr>
												 <th>ID</th>
	                                            <th>In Time</th>
												 <th>Out time</th>
												<th>Time </th>	
	                                        </tr>
	                                    </thead>
										<?php
										
											foreach($rec as $row){
												
												//$img=explode(',',$row->image);
										?>
	                                    <tbody>
	                                        <tr class="gradeX">	
	                                            <td><?php echo $row->id; ?> </td>
													<td><?php echo $row->login_time;?></td>
	                                           <!-- <td><?php //echo $row['product_detail'];?></td>-->
	                                            <td><?php echo $row->logout_time;?></td>
												 <td><?php
													$datetime1 = new DateTime($row->login_time);
													$datetime2 = new DateTime($row->logout_time);
													$interval = $datetime1->diff($datetime2);
													echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes"; ?></td>
	                                        </tr>
											<?php }?>
											
	                                    </tbody>
											
	                                </table>
									
									<b style="color:green";>Total:<?php echo $count;?></b>
									
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
		<?php $this->load->view('Admin/footer');?>
	
	