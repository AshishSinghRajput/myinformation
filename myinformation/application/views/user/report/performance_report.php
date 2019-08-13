<div class="row" style="background-color:white;">
                    <!-- ngView:  --><div ng-view="" class="ng-scope"><meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate" class="ng-scope">
<meta http-equiv="Pragma" content="no-cache" class="ng-scope">
<div id="page-wrapper" ng-app="MyIncomeApp" ng-controller="PerformanceReportsCtrl" class="ng-scope" style="min-height: 324px;">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Performance Report</h1>
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
            <img src="images/Excel.png" ng-click="ExportToExcel()">
        </div>
        <div class="row form-group">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='sd'; reverseSort = !reverseSort">
                                Scheduled Dates<span ng-show="orderByField == 'sd'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='rsv'; reverseSort = !reverseSort">
                                Personal SV<span ng-show="orderByField == 'rsv'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='sv'; reverseSort = !reverseSort">
                                GSV Left<span ng-show="orderByField == 'sv'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='lsv'; reverseSort = !reverseSort">
                                GSV Right<span ng-show="orderByField == 'lsv'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                      
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='ps'; reverseSort = !reverseSort">
                                Personally Sponsered<span ng-show="orderByField == 'ps'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='desg'; reverseSort = !reverseSort">
                                Level<span ng-show="orderByField == 'desg'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='schinc'; reverseSort = !reverseSort">
                                Commission<span ng-show="orderByField == 'schinc'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>


                    </tr>
                    <tr></tr>
                    <!-- ngRepeat: PR in PerformanceRpt | filter:search | itemsPerPage:ItemsperPage|orderBy:orderByField:reverseSort track by $index -->
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
<meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate" class="ng-scope">
<meta http-equiv="Pragma" content="no-cache" class="ng-scope"></div>
                    <div id="footer" ng-controller="FooterGetLastLogin" class="ng-scope">
                        <div class="container">
                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-8 text-p ng-binding">
                                Last Login: Nov 29 2017  3:25PM
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 text-p hidden-xs" style="text-align:right;">
                                Powered by
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-4 logo">
                                <img src="images/smartsoft-logo.png" class="img-responsive" alt="">
                            </div>
                            <!-- <p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>-->
                        </div>
                    </div>
                </div>