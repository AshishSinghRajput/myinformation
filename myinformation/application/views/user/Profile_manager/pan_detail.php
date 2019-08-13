<div style="background-color:white;" id="page-wrapper" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ng-scope" ng-app="ProfileManagerApp" ng-controller="PanDetailsCtrl" style="min-height: 324px;">

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">PAN Details</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row col-md-offset-3" ng-show="!Rpt">
        <form name="Form_BankDetails" novalidate="" class="ng-pristine ng-invalid ng-invalid-required">
            <div>
                <div class="row form-group">
                    <div class="col-md-6" ng-class="{ 'has-error' : Form_BankDetails.PanCard.$invalid &amp;&amp; !Form_BankDetails.PanCard.$pristine }">
                        <label class="col-sm-4 control-label label-right">
                            PAN Card No
                        </label>
                        <label class="col-sm-1 control-label">
                            :
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-uppercase ng-pristine ng-invalid ng-invalid-required ng-valid-pattern" id="txtPanCard" name="PanCard" ng-pattern="/^[A-Za-z]{5}\d{4}[A-Za-z]$/" ng-model="PAN" placeholder="Enter PanCard" required="">

                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6" ng-class="{ 'has-error' : Form_BankDetails.PanCard.$invalid &amp;&amp; !Form_BankDetails.PanCard.$pristine }">
                        <label class="col-sm-4 control-label label-right">
                            Upload PAN Card
                        </label>
                        <label class="col-sm-1 control-label">
                            :
                        </label>
                        <div class="col-sm-7">
                            <input type="file" id="myFile" name="myFile" ng-model="FileName" class="ng-pristine ng-valid">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-offset-3" id="imagePreview">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-offset-2 col-md-3">
                        <button type="button" id="btnUpload" ng-click="PanDetailsSubmit();" ng-disabled="Form_BankDetails.$invalid || loader" class="btn btn-default" disabled="disabled">
                            Submit
                        </button>
                        <img ng-show="loader" src="images/loading.gif" class="loading ng-hide">
                    </div>
                    <div class="col-md-1">
                        <button type="button" id="btnback" ng-click="Back()" class="btn btn-default">
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--Admin Report Start-->
    <div ng-show="Rpt" class="ng-hide">
        <div class="row">
            <div class="col-md-3 form-group">
                <input type="text" name="txtSearch" ng-model="search" class="form-control ng-pristine ng-valid" placeholder="search...">
            </div>
            <div class="col-md-offset-6 col-md-1">
                <img src="images/Excel.png" ng-click="SOWardExportToExcel()">
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='MemberID'; reverseSort = !reverseSort">
                                Associate ID <span ng-show="orderByField == 'MemberID'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Name'; reverseSort = !reverseSort">
                                Name <span ng-show="orderByField == 'Name'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PanImg'; reverseSort = !reverseSort">
                                Image <span ng-show="orderByField == 'PanImg'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PanNo'; reverseSort = !reverseSort">
                                PAN No <span ng-show="orderByField == 'PanNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Status'; reverseSort = !reverseSort">
                                Status <span ng-show="orderByField == 'Status'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>

                    </tr>
                    <!-- ngRepeat: SO in BankApproveRpt | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort track by $index -->
                </tbody></table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <dir-pagination-controls max-size="15" direction-links="true" boundary-links="true" class="ng-isolate-scope"><!-- ngIf: 1 < pages.length --></dir-pagination-controls>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>
    <!--Admin Rpt End-->
</div>