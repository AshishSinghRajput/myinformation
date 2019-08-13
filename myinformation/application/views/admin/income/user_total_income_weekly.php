    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>  
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>-->
     <link  type="text/css"/  rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<div class="container">
    <div class="row">
    	 <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Total Income Weekly</b></h4>
              <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">From Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label">To Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="to_date" name="to_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
                <!--<table id="datatable-buttons" class="table table-striped table-bordered table-hover">-->
                            <table id="table" class="table table-striped table-bordered table-hover text-nowrap">
                                <thead class="text-nowrap">
                                <tr>
                                    <th >#</th>
                                    <th >User Id</th>
                                    <th >User Name</th>
                                    <th >User Mobile</th>
                                    <th >User Email</th>
                                    <th >My Activate Plan</th>
                                    <!--<th >Date</th>-->
                                    <th>Today's My Step Income</th>
                                    <th>Today's My Matching Income</th>
                                    <th>Today's My Income</th>
                                    <th>My Last Balance Account</th>
                                    <th>Today's Total Income</th>
                                    <th>Reacived Cashed Payment by Pin System</th>
                                    <th>Rest Payment</th>
                                    <th>Do You Want Rest Payement Now</th>
                                    <th>Remark</th>
                                </tr>
                                </thead>
                            </table>
                           <?php //} else{ echo "<h3><span class='text-danger'>Not Any Posted Blog</span></h3>";} ?>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
         </div> <!-- content -->
      </div>
   </body>
</html>