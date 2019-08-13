
<div id="page-wrapper" style="background-color:white;">
    <section class="right-content" style="backgroud:white;" >
        <div class="row top-row-strip" style="margin-top:10px" style="background-color:white;">
            <div class="col-md-11">

                <h3 class="ng-binding">New Order Reports</h3>

            </div>
            <div class="col-md-1">
                <button class="btn btn-primary btn-sm" data-toggle="collapse" ng-click="addcollapsecss()">
                    Filter
                </button>
            </div>

        </div>
        <div class="collapse in" ng-class="Filter==true?'in' : ''" style="background-color:white;">
            <div class="well" style="background-color:white;">

                <form name="MenuForm" novalidate="" class="ng-pristine ng-valid ng-valid-required">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="rbcontent" ng-model="rbcontent" value="rball" ng-checked="true" ng-change="AssignValidations()" class="ng-pristine ng-valid" checked="checked">
                                    All
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-2">
                            <div class="radio">
                                <label class="control-label">
                                    <input type="radio" name="rbcontent" ng-model="rbcontent" value="rbon" ng-change="AssignValidations()" class="ng-pristine ng-valid">
                                    On
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input id="ondate" type="text" class="form-control ng-pristine hasDatepicker ng-valid ng-valid-required" placeholder="Select Ondate" ng-model="txtOndate" datepicker="" ng-required="OnRequired" ng-readonly="true" readonly="readonly">
                        </div>
                    </div>
                    <div class="row" ng-class="{ 'has-error' : MenuForm.txtFromdate.$invalid &amp;&amp; !MenuForm.txtFromdate.$pristine &amp;&amp; MenuForm.txtTodate.$invalid &amp;&amp; !MenuForm.txtTodate.$pristine }">
                        <div class="col-md-offset-1 col-md-2">
                            <div class="radio">
                                <label class="control-label">
                                    <input type="radio" name="rbcontent" ng-model="rbcontent" value="FromTo" ng-change="AssignValidations()" class="ng-pristine ng-valid">
                                    From
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input id="Fromdate" type="text" class="form-control ng-pristine hasDatepicker ng-valid ng-valid-required" datepicker="" ng-model="txtFromdate" ng-click="OnRequired" placeholder="Select Fromdate" ng-required="fromtoRequired" ng-readonly="true" readonly="readonly">

                        </div>
                        <div class="col-md-1 label-right"><label class="control-label">To </label></div>
                        <div class="col-md-3">

                            <input id="Todate" type="text" class="form-control ng-pristine hasDatepicker ng-valid ng-valid-required" datepicker="" ng-model="txtTodate" ng-click="OnRequired" placeholder="Select Todate" ng-required="fromtoRequired" ng-readonly="true" readonly="readonly">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-offset-3 col-md-3">
                            <button type="button" ng-click="GetIDSummaryRpt()" class="btn btn-primary btn-sm" ng-disabled="MenuForm.$invalid || loader">Get Report</button>
                        </div>
                        <div class="col-md-1">
                            <img ng-show="loader" src="images/loading.gif" class="loading ng-hide">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-default btn-sm" ng-click="FiltermenuCancel()">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

       

    </section>
</div>
