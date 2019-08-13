<div ng-view="" class="ng-scope"><div id="page-wrapper" ng-app="myecashApp" ng-controller="CreditRequestReportCtrl" class="ng-scope">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Credit Request Report</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

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
        <div class="row form-group">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='CreditReqNo'; reverseSort = !reverseSort">
                                Credit RequestNo<span ng-show="orderByField == 'CreditReqNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Amount'; reverseSort = !reverseSort">
                                Amount<span ng-show="orderByField == 'Amount'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='MemberID'; reverseSort = !reverseSort">
                                AssociateID<span ng-show="orderByField == 'MemberID'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='City'; reverseSort = !reverseSort">
                                City<span ng-show="orderByField == 'City'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Remarks'; reverseSort = !reverseSort">
                                Credited By<span ng-show="orderByField == 'Remarks'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                    </tr>
                    <tr></tr>
                    <!-- ngRepeat: SO in StockOrderRpt | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort track by $index -->
                </tbody></table>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-11">
                <dir-pagination-controls max-size="15" direction-links="true" boundary-links="true" class="pagination ng-isolate-scope"><!-- ngIf: 1 < pages.length --></dir-pagination-controls>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>

</div>


</div>