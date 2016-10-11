<html ng-app="rsw">
<head>
    <title>Resturant Reviewer</title>

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="icon" type="image/png" sizes="196x196" href="images/AppIcon.png">
    <link rel="apple-touch-icon" href="images/AppIcon.png">
    <link rel="apple-touch-startup-image" href="images/AppIcon.png">
    <meta name="viewport" content="width=device-width" />
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, height=device-height, width=device-width" />
    <link rel="stylesheet" href="css/master.css" type="text/css">
</head>
<body ng-controller="master" ng-cloak>
    <div class="container-fluid">
        <div class="row row-centered planner-block">
            <div class="col-md-12">
                <div class="row row-centered">
                    <div class="col-md-12 col-centered form-planner-inner">
                        <header>
                            <nav role="navigation" class="navbar navbar-default navbar-static-top">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                       <a href="#" class="navbar-brand" role="heading" aria-level="1">Resturant Reviewer App</a>
                                    </div>
                                    <div class="navbar-right">
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <select ng-focus="updL()" ng-change="onChangeFL()" aria-label="Filter" name="filterl" class="form-control filter" ng-model="form.filterl" ng-required="true">
                                                            <option value="">--Filter Location--</option>
                                                            <option ng-repeat="f in filterl" value="{{ f }}">{{ f }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select ng-focus="updC()" ng-change="onChangeFC()" aria-label="Filter" name="filterc" class="form-control filterc" ng-model="form.filterc" ng-required="true">
                                                            <option value="">--Filter Cuisine--</option>
                                                            <option ng-repeat="fc in filterc" value="{{ fc }}">{{ fc }}</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </header>
                        <main>
                            <img src="images/banner1.jpg" class="img-responsive" alt="Brand Cover Photo">
	                        <div id="rest-list">    
								<a href="#" ng-repeat="r in resturant track by $index" data-toggle="modal" data-target="#restaurant-{{ $index }}" ng-click="empty()">
	                                <div class="col-md-6 col-centered form-planner-inner">
	                                    <span class="form-text">{{ r.Name }}</span><br>
	                                    <address><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> &nbsp;{{ r.Address }}</address>
	                                    <img class="img-responsive" src="{{ r.Image }}" alt="{{ r.Name }} Image"><br>
	                                    <hr/>
	                                    <table class="eventActive">
                                            <caption><strong><center><a href="#">Click To Read Reviews</a></center></strong></caption>
	                                        <tr>
	                                            <td><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> &nbsp;{{ r.Type }}</td>
	                                            <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp;{{ r.Hours }}</td>
	                                        </tr>
	                                    </table>
	                                </div>
                                </a>
                                <span ng-repeat="r in resturant track by $index">
                                    <div class="modal fade" id="restaurant-{{ $index }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">{{ r.Name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b><center>Reviews</center></b>
                                                    <br>
                                                    <div ng-repeat="rvs in reviews | filter:{ Name: r.Name  }" style="text-align: left;">
                                                        <p> By: {{ rvs.Reviewer }} </p>
                                                        <p> Says: {{ rvs.Comments }} </p>
                                                        <p> Rated: {{ rvs.Rating }}/5 </p>
                                                        <p> On: {{ rvs.Date}} </p>
                                                        <hr>
                                                    </div>
                                                    <div ng-repeat="u in user" style="text-align: left;">
                                                        <p> By: {{ u.Reviewer }} </p>
                                                        <p> Says: {{ u.Comments }} </p>
                                                        <p> Rated: {{ u.Rating }}/5 </p>
                                                        <p> On: {{ u.Date }} </p>
                                                        <hr>
                                                    </div>
                                                    <br>
                                                    <h3>Add Review</h3>
                                                    <form name="signup" ng-submit="validate(userInfo);" onsubmit="return false;">
                                                        <div class="form-group">
                                                            <input aria-label="Full Name" type="textfield" class="form-control" ng-required="true" name="fname" placeholder="Full Name" ng-minlength="2" ng-model="userInfo.name"/>
                                                            <span ng-show="signup.fname.$touched && signup.fname.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.fname.$touched && signup.fname.$invalid">
                                                                Please enter a valid name
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea aria-label="Comments" class="form-control" placeholder="Your Comments" ng-required="true" ng-minlength="2" ng-model="userInfo.gList" name="glist" cols="50" rows="3"></textarea>
                                                            <span ng-show="planner.glist.$touched && planner.glist.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="planner.glist.$touched && planner.glist.$invalid">
                                                                Please provide a valid comment
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Rating" type="number" class="form-control" ng-required="true" name="rate" placeholder="Rating" ng-model="userInfo.rate" min="1" max="5"/>
                                                            <span ng-show="signup.rate.$touched && signup.rate.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.rate.$touched && signup.rate.$invalid">
                                                                Please enter a valid number
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Post Comment" class="btn btn-primary form-control" ng-show="signup.$valid" type="submit" value="Post Comment">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
							</div>
							<div id="rest-list-f" class="offVal">
	                            <a href="#" ng-repeat="s in resturants | filter:{ Address: filterTypeL  } track by $index"  data-toggle="modal" data-target="#restaurants-{{ $index }}" ng-click="empty()">
	                                <div class="col-md-6 col-centered form-planner-inner">
	                                    <span class="form-text">{{ s.Name }}</span><br>
	                                    <address><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> &nbsp;{{ s.Address }}</address>
	                                    <img class="img-responsive" src="{{ s.Image }}" alt="{{ s.Name }} Image"><br>
	                                    <hr/>
	                                    <table class="eventActive">
	                                        <caption><strong><center><a href="#">Click To Read Reviews</a></center></strong></caption>
	                                        <tr>
	                                            <td><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> &nbsp;{{ s.Type }}</td>
	                                            <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp;{{ s.Hours }}</td>
	                                        </tr>
	                                    </table>
	                                </div>
	                            </a>
                                <span ng-repeat="s in resturants | filter:{ Address: filterTypeL  } track by $index">
                                    <div class="modal fade" id="restaurants-{{ $index }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">{{ s.Name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b><center>Reviews</center></b>
                                                    <br>
                                                    <div ng-repeat="rvss in reviewss | filter:{ Name: s.Name  }" style="text-align: left;">
                                                        <p> By: {{ rvss.Reviewer }} </p>
                                                        <p> Says: {{ rvss.Comments }} </p>
                                                        <p> Rated: {{ rvss.Rating }}/5 </p>
                                                        <p> On: {{ rvss.Date}} </p>
                                                        <hr>
                                                    </div>
                                                    <div ng-repeat="us in user" style="text-align: left;">
                                                        <p> By: {{ us.Reviewer }} </p>
                                                        <p> Says: {{ us.Comments }} </p>
                                                        <p> Rated: {{ us.Rating }}/5 </p>
                                                        <p> On: {{ us.Date }} </p>
                                                        <hr>
                                                    </div>
                                                    <br>
                                                    <h3>Add Review</h3>
                                                    <form name="signup" ng-submit="validate(userInfo);" onsubmit="return false;">
                                                        <div class="form-group">
                                                            <input aria-label="Full Name" type="textfield" class="form-control" ng-required="true" name="fname" placeholder="Full Name" ng-minlength="2" ng-model="userInfo.name"/>
                                                            <span ng-show="signup.fname.$touched && signup.fname.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.fname.$touched && signup.fname.$invalid">
                                                                Please enter a valid name
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea aria-label="Comments" class="form-control" placeholder="Your Comments" ng-required="true" ng-minlength="2" ng-model="userInfo.gList" name="glist" cols="50" rows="3"></textarea>
                                                            <span ng-show="planner.glist.$touched && planner.glist.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="planner.glist.$touched && planner.glist.$invalid">
                                                                Please provide a valid comment
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Rating" type="number" class="form-control" ng-required="true" name="rate" placeholder="Rating" ng-model="userInfo.rate" min="1" max="5"/>
                                                            <span ng-show="signup.rate.$touched && signup.rate.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.rate.$touched && signup.rate.$invalid">
                                                                Please enter a valid number
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Post Comment" class="btn btn-primary form-control" ng-show="signup.$valid" type="submit" value="Post Comment">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
							</div>
							<div id="rest-list-c" class="offVal">
	                            <a href="#" ng-repeat="c in resturantc | filter:{ Type: filterTypeC  } track by $index" data-toggle="modal" data-target="#restaurantc-{{ $index }}" ng-click="empty()">
	                                <div class="col-md-6 col-centered form-planner-inner">
	                                    <span class="form-text">{{ c.Name }}</span><br>
	                                    <address><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> &nbsp;{{ c.Address }}</address>
	                                    <img class="img-responsive" src="{{ c.Image }}" alt="{{ c.Name }} Image"><br>
	                                    <hr/>
	                                    <table class="eventActive">
                                            <caption><strong><center><a href="#">Click To Read Reviews</a></center></strong></caption>
	                                        <tr>
	                                            <td><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> &nbsp;{{ c.Type }}</td>
	                                            <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp;{{ c.Hours }}</td>
	                                        </tr>
	                                    </table>
	                                </div>
                                </a>
                                <span ng-repeat="c in resturantc | filter:{ Type: filterTypeC  } track by $index">
                                    <div class="modal fade" id="restaurantc-{{ $index }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ c.Name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b><center>Reviews</center></b>
                                                    <br>
                                                    <div ng-repeat="rvsc in reviewsc | filter:{ Name: c.Name  }" style="text-align: left;">
                                                        <p> By: {{ rvsc.Reviewer }} </p>
                                                        <p> Says: {{ rvsc.Comments }} </p>
                                                        <p> Rated: {{ rvsc.Rating }}/5 </p>
                                                        <p> On: {{ rvsc.Date}} </p>
                                                        <hr>
                                                    </div>
                                                    <div ng-repeat="uc in user" style="text-align: left;">
                                                        <p> By: {{ uc.Reviewer }} </p>
                                                        <p> Says: {{ uc.Comments }} </p>
                                                        <p> Rated: {{ uc.Rating }}/5 </p>
                                                        <p> On: {{ uc.Date }} </p>
                                                        <hr>
                                                    </div>
                                                    <br>
                                                    <h3>Add Review</h3>
                                                    <form name="signup" ng-submit="validate(userInfo);" onsubmit="return false;">
                                                        <div class="form-group">
                                                            <input aria-label="Full Name" type="textfield" class="form-control" ng-required="true" name="fname" placeholder="Full Name" ng-minlength="2" ng-model="userInfo.name"/>
                                                            <span ng-show="signup.fname.$touched && signup.fname.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.fname.$touched && signup.fname.$invalid">
                                                                Please enter a valid name
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea aria-label="Comments" class="form-control" placeholder="Your Comments" ng-required="true" ng-minlength="2" ng-model="userInfo.gList" name="glist" cols="50" rows="3"></textarea>
                                                            <span ng-show="planner.glist.$touched && planner.glist.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="planner.glist.$touched && planner.glist.$invalid">
                                                                Please provide a valid comment
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Rating" type="number" class="form-control" ng-required="true" name="rate" placeholder="Rating" ng-model="userInfo.rate" min="1" max="5"/>
                                                            <span ng-show="signup.rate.$touched && signup.rate.$invalid"><br></span>
                                                            <div class="alert alert-danger" role="alert" ng-show="signup.rate.$touched && signup.rate.$invalid">
                                                                Please enter a valid number
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input aria-label="Post Comment" class="btn btn-primary form-control" ng-show="signup.$valid" type="submit" value="Post Comment">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
							</div>							
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/master.js"></script>
    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('./service-worker.js').then(function() {
            }, function() {
                console.log('CLIENT: service worker registration failure.');
            });
        } else {
            console.log('CLIENT: service worker is not supported.');
        }
    </script>
</body>
</html>