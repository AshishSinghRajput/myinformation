<div style="background-color:white"><div id="page-wrapper" ng-app="MyOrdersApp" ng-controller="MyShopCtrl" class="ng-scope">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">My Shop</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 ng-pristine ng-invalid ng-invalid-required" ng-form="FrmIdno" novalidate="">
            <div class="col-md-offset-2">
                <div class="row">
                    <div class="col-md-7" ng-class="{ 'has-error' : FrmIdno.Idno.$invalid &amp;&amp; !FrmIdno.Idno.$pristine }">
                        <label class="col-sm-4 control-label label-right">
                            Associate ID
                        </label>
                        <label class="col-sm-1 control-label">
                            :
                        </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control ng-pristine ng-invalid ng-invalid-required" name="Idno" placeholder="Enter Associate ID" id="txtidno" ng-model="idno" ng-mouseleave="getdetails()" required="">
                        </div>
                    </div>
                    <div class="col-md-7 ng-hide" ng-class="{ 'has-error' : FrmIdno.Idno.$invalid &amp;&amp; !FrmIdno.Idno.$pristine }" ng-show="disp">
                        <label class="col-sm-4 control-label label-right">
                            Associate Name
                        </label>
                        <label class="col-sm-1 control-label">
                            :
                        </label>
                        <div class="col-sm-7">
                            <label class="ng-binding"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-offset-2 col-sm-offset-2 col-md-4 col-sm-4">
                        <button type="button" id="btnsubmit" ng-click="CheckDownlineid()" ng-disabled="FrmIdno.$invalid || loader" class="btn btn-default" disabled="disabled">
                            Submit
                        </button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mydiv" ng-show="loader" class="ng-hide">
        <img src="images/loading.gif" class="ajax-loader">
    </div>
</div>


</div>