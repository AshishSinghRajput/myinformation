<div ng-view="" class="ng-scope"><meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate" class="ng-scope">
<meta http-equiv="Pragma" content="no-cache" class="ng-scope">
<div id="page-wrapper" ng-app="MyIncomeApp" ng-controller="MissingLevelDownRptCtrl" class="ng-scope" style="min-height: 324px;">
    <section class="right-content">
        <div class="row top-row-strip" style="margin-top:10px">
            <div class="col-md-10">
                <h1 class="page-header ng-binding">Missing Level Down Report</h1>
            </div>
            
            <div class="col-md-2" style="margin-top:10px;margin-bottom:10px">
                <a class="btn btn-primary btn-sm ng-hide" ng-show="ShowGoBack" ng-click="btnGoBack()">Go Back</a>
            </div>

        </div>


        

        <div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="text" name="txtSearch" ng-model="search" class="form-control ng-pristine ng-valid" placeholder="search...">
                </div>
                <div class="col-md-2">
                    <!--<label for="search">items per page:</label>-->
                    <!--<input type="number" ng-minlength="1" ng-maxlength="100" class="form-control" ng-model="ItemsperPage">-->

                    <select ng-model="ItemsperPage" class="form-control ng-pristine ng-valid">
                        <option value="" style="display:none">Items Per Page</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-offset-8 col-md-1">
                    <!--<img src="images/Excel.png" ng-click="SOWardExportToExcel()" />-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="overflow-x:scroll">
                    <table class="table table-bordered table-striped">
                        <tbody><tr>
                            <th class="label-center" style="width:5%"><a style="text-decoration: none">SNo</a></th>
                            <th class="label-center" style="width:5%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='MemberID'; reverseSort = !reverseSort">
                                    AssociateID<span ng-show="orderByField == 'MemberID'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:20%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Name'; reverseSort = !reverseSort">
                                    Name<span ng-show="orderByField == 'Name'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Mobile'; reverseSort = !reverseSort">
                                    Mobile<span ng-show="orderByField == 'Mobile'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:5%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='SponsorID'; reverseSort = !reverseSort">
                                    SponsorID<span ng-show="orderByField == 'SponsorID'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:20%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Sponsor'; reverseSort = !reverseSort">
                                    Sponsor<span ng-show="orderByField == 'Sponsor'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='City'; reverseSort = !reverseSort">
                                    City<span ng-show="orderByField == 'City'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='State'; reverseSort = !reverseSort">
                                    State<span ng-show="orderByField == 'State'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='JoiningDate'; reverseSort = !reverseSort">
                                    JoiningDate<span ng-show="orderByField == 'JoiningDate'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='CFL'; reverseSort = !reverseSort">
                                    CFL<span ng-show="orderByField == 'CFL'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='CFR'; reverseSort = !reverseSort">
                                    CFR<span ng-show="orderByField == 'CFR'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='CurLeft'; reverseSort = !reverseSort">
                                    CurLeft<span ng-show="orderByField == 'CurLeft'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='CurRight'; reverseSort = !reverseSort">
                                    CurRight<span ng-show="orderByField == 'CurRight'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TotalLeft'; reverseSort = !reverseSort">
                                    TotalLeft<span ng-show="orderByField == 'TotalLeft'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TotalRight'; reverseSort = !reverseSort">
                                    TotalRight<span ng-show="orderByField == 'TotalRight'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='HDesg'; reverseSort = !reverseSort">
                                    HDesg<span ng-show="orderByField == 'HDesg'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='MinimumPSVRequired'; reverseSort = !reverseSort">
                                    MinimumPSVRequired<span ng-show="orderByField == 'MinimumPSVRequired'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Achieved'; reverseSort = !reverseSort">
                                    Achieved<span ng-show="orderByField == 'Achieved'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Balance'; reverseSort = !reverseSort">
                                    Balance<span ng-show="orderByField == 'Balance'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                            <th class="label-center" style="width:10%">
                                <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PayNo'; reverseSort = !reverseSort">
                                    PayNo<span ng-show="orderByField == 'PayNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                                </a>
                            </th>
                        </tr>
                        <tr></tr>
                        <!-- ngRepeat: PO in MissingLevelReprt | filter:search | itemsPerPage:ItemsperPage |orderBy:orderByField:reverseSort track by $index -->
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
    </section>
</div>
<meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate" class="ng-scope">
<meta http-equiv="Pragma" content="no-cache" class="ng-scope"></div>