
    <div class="row" style="background-color:white;">
        <div class="col-lg-12">
            <h1 class="page-header">Commission Report</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row" style="background-color:white;">
        
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
        <div class="col-md-offset-6 col-md-1">
            <!--<img src="images/Excel.png" ng-click="ExportToExcel()" />-->
        </div>
        <div class="row form-group">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PayNo'; reverseSort = !reverseSort">
                                Payout No<span ng-show="orderByField == 'PayNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='sdate'; reverseSort = !reverseSort">
                                Scheduled Dates<span ng-show="orderByField == 'sdate'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PFB'; reverseSort = !reverseSort">
                                Path Finders Bonus<span ng-show="orderByField == 'PFB'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TRB'; reverseSort = !reverseSort">
                                Training Bonus<span ng-show="orderByField == 'TRB'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TB'; reverseSort = !reverseSort">
                                Team Bonus<span ng-show="orderByField == 'TB'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Total'; reverseSort = !reverseSort">
                                Gross Amount<span ng-show="orderByField == 'Total'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TDS'; reverseSort = !reverseSort">
                                TDS<span ng-show="orderByField == 'TDS'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='NetAmt'; reverseSort = !reverseSort">
                                Net Amount<span ng-show="orderByField == 'NetAmt'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>

                    </tr>
                    <tr></tr>
                    <!-- ngRepeat: Comm in CommRpt | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort  track by $index -->
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