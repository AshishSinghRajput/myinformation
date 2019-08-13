<div id="page-wrapper" ng-app="MyOrdersApp" ng-controller="ShippingInformationCtrl" class="ng-scope">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Shipping Information</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
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
                <img src="images/Excel.png" ng-click="ExportToExcel()">
            </div>
        </div>
        <!--<div class="row form-group">
        <div class="col-md-4 col-md-offset-5">
            <img ng-show="loader" align="middle" src="images/loading.gif" class="loading" />
        </div>
    </div>-->

        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='BillNo'; reverseSort = !reverseSort">
                                Invoice No <span ng-show="orderByField == 'BillNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='billdate'; reverseSort = !reverseSort">
                                Invoice Date <span ng-show="orderByField == 'billdate'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Products'; reverseSort = !reverseSort">
                                Products <span ng-show="orderByField == 'Products'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='ModeOfDisp'; reverseSort = !reverseSort">
                                Mode Of Dispatch <span ng-show="orderByField == 'ModeOfDisp'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Remarks'; reverseSort = !reverseSort">
                                Remarks <span ng-show="orderByField == 'Remarks'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='ShpAddress'; reverseSort = !reverseSort">
                                Shipping Address <span ng-show="orderByField == 'ShpAddress'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                    </tr>
                    <tr></tr>
                    <!-- ngRepeat: SD in ShipDetails | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort track by $index -->
                </tbody></table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <dir-pagination-controls max-size="15" direction-links="true" boundary-links="true" class="pagination ng-isolate-scope"><!-- ngIf: 1 < pages.length --></dir-pagination-controls>
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </div>
</div>