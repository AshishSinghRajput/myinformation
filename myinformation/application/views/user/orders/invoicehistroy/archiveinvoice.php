<div style="background:white;">
    <section class="right-content" style="background:white;">
        <div class="row top-row-strip" style="margin-top:10px">
            <div class="col-md-11">
                <h3 class="ng-binding">Archeive Order Reports</h3>
            </div>
         

        </div>
        <div class="collapse in" style="background:white;">
            <div class="well" style="background-color:white;" >

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
                            <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtOndate" is-open="ondatests.opened" ng-click="OnRequired && openondatests()"
                                   min-date="minDate" max-date="maxDate" datepicker-options="dateOptions" placeholder="Select Ondate"
                                   show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="OnRequired" />-->



                            <input type="text" class="form-control ng-pristine ng-valid ng-valid-required" placeholder="Select Ondate" ng-model="txtOndate" datepickerf="" ng-click="OnRequired &amp;&amp; openondatests()" ng-required="OnRequired" ng-readonly="true" readonly="readonly">

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
                            <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtFromdate" is-open="fromdatests.opened" ng-click="fromtoRequired && openfromdatests()"
                                   min-date="minDate" max-date="frommaxDate" datepicker-options="dateOptions" placeholder="Select Fromdate"
                                   show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="fromtoRequired" ng-change="Assigntomaxdate()" />-->
                            <input type="text" class="form-control ng-pristine ng-valid ng-valid-required" datepickerf="" ng-model="txtFromdate" placeholder="Select Fromdate" ng-click="OnRequired" ng-required="fromtoRequired" ng-readonly="true" ng-change="Assigntomaxdate()" readonly="readonly">
                        </div>
                        <div class="col-md-1 label-right"><label class="control-label">To </label></div>
                        <div class="col-md-3">
                            <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtTodate" is-open="todatests.opened" ng-click="fromtoRequired && opentodatests()"
                                   min-date="tominDate" max-date="maxDate" datepicker-options="dateOptions" placeholder="Select Todate"
                                   show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="fromtoRequired" ng-change="Assignfrommaxdate()" />-->
                            <input type="text" class="form-control ng-pristine ng-valid ng-valid-required" datepickerf="" ng-model="txtTodate" placeholder="Select Todate" ng-click="OnRequired" ng-required="fromtoRequired" ng-readonly="true" ng-change="Assignfrommaxdate()" readonly="readonly">
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