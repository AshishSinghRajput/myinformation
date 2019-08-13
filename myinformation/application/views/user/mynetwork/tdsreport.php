<div id="page-wrapper" ng-app="MyIncomesApp" ng-controller="MyTDSListCtrl" class="ng-scope" style="background-color:white;">

    <div class="row" style="background-color:white;">
        <div class="col-lg-12">
            <h1 class="page-header">My TDS List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row" style="background-color:white;">
       
        <div class="col-md-3 form-group">
            <input type="text" name="txtSearch" ng-model="search" class="form-control ng-pristine ng-valid" placeholder="search...">
        </div>
        <div class="col-md-offset-8 col-md-1">
            <img src="images/Excel.png" ng-click="ExportToExcel()">
        </div>
        <div class="row form-group">
            <div class="col-md-12 class=" table-responsive""="">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='payno'; reverseSort = !reverseSort">
                                Payout No<span ng-show="orderByField == 'payno'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='schfrom'; reverseSort = !reverseSort">
                                Scheduled Dates<span ng-show="orderByField == 'schfrom'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='GrossAmt'; reverseSort = !reverseSort">
                                Gross Amount<span ng-show="orderByField == 'GrossAmt'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='TDS'; reverseSort = !reverseSort">
                                TDS<span ng-show="orderByField == 'TDS'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                    </tr>
                    <tr></tr>
                    <!-- ngRepeat: TDS in TDSRpt | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort track by $index -->
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