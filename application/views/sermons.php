<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- Angular -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.js"></script>
<script>
var sermonPage = angular.module("sermonPage", []);

sermonPage.controller("mainController", ['$scope', '$sce', '$http', function($scope, $sce, $http) {
    var nextPageToken = null;
    var prevPageToken = null;
    $scope.currentPage = 1;
    $scope.sermons = [];
    $scope.speakers = [];
    $scope.topics = [];
    $scope.passages = [];

    function filterSermons() {
        var first = ($scope.currentPage - 1) * 12;
        $scope.sermons = $scope.allSermons.slice(first, first+12);
    }

    $scope.allSermons = [];

//    $scope.$watch("currentPage", function() {
//        filterSermons();
//    })

    function searchQuery(query) {
        if(query == null || query == "") {
            getVideos();
            return;
        }
        $http.get("https://www.googleapis.com/youtube/v3/search?part=id,snippet&channelId=UCe-RJ-3Q3tUqJciItiZmjdg&key=AIzaSyDhBQdQtap8Z539l58EHnjaJxOKAcoElwQ&type=video&q=" + query).then(function(response) {
            console.log(response.data);
            loadVideos(response.data, true);
        })
    }

    function loadVideos(videoData, isSearch, cb) {
        console.log(videoData);
        videoData.items.forEach(function(sermonData) {
            var newSermon = {};
            newSermon.image = sermonData.snippet.thumbnails.medium.url;
            newSermon.date = sermonData.snippet.publishedAt;
            newSermon.title = sermonData.snippet.title;
            newSermon.description = sermonData.snippet.description;
            newSermon.speaker = "";
            newSermon.topic = "";
            newSermon.passage = "";
            var description = newSermon["description"];
            var descriptionLines = description.split("\n");
            descriptionLines.forEach(function(line) {
                if(line.indexOf("Speaker: ") == 0) {
                    newSermon["speaker"] = line.substr(9);
                }
                if(line.indexOf("Topic: ") == 0) {
                    newSermon["topic"] = line.substr(7);
                }
                if(line.indexOf("Passage: ") == 0) {
                    newSermon["passage"] = line.substr(9);
                }
            })
            newSermon["subtitle"] = "" + newSermon["speaker"];
            if(newSermon["speaker"] != "" && newSermon["passage"] != "") {
                newSermon["subtitle"] += " / ";
            }
            newSermon["subtitle"] += newSermon["passage"];
            if(!isSearch) {
                newSermon["videoId"] = sermonData.snippet.resourceId.videoId;
            } else {
                newSermon["videoId"] = sermonData.id.videoId;
            }
            newSermon["viewCount"] = 0;
            if ($scope.speakers.indexOf(newSermon["speaker"]) == -1 && newSermon["speaker"] != "") {
                $scope.speakers.push(newSermon["speaker"]);
            }
            if ($scope.topics.indexOf(newSermon["topic"]) == -1 && newSermon["topic"] != "") {
                $scope.topics.push(newSermon["topic"]);
            }
            if ($scope.passages.indexOf(newSermon["passage"]) == -1 && newSermon["speaker"] != "") {
                $scope.passages.push(newSermon["passage"]);
            }
            $scope.allSermons.push(newSermon);
        });
        nextPageToken = videoData.nextPageToken;
        prevPageToken = videoData.prevPageToken;
        if(nextPageToken == null) {
            $scope.currentPage = 1;
        }
        cb();
    }

    function getVideos(pageToken) {
        var apiUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLi2onRqvLcjnULwq581sf-6w26kuHe2P3&key=AIzaSyDhBQdQtap8Z539l58EHnjaJxOKAcoElwQ&maxResults=50&order=date"
        if(pageToken != null) {
            apiUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLi2onRqvLcjnULwq581sf-6w26kuHe2P3&key=AIzaSyDhBQdQtap8Z539l58EHnjaJxOKAcoElwQ&maxResults=50&order=date&pageToken=" + pageToken;
        }
        $http.get(apiUrl).then(function (response) {
            loadVideos(response.data, false, function() {
                console.log(nextPageToken);
                if(nextPageToken != null)
                getVideos(nextPageToken);
            });
        })
    }


    $scope.search = function(searchText) {
        searchQuery(searchText);
    }

    $scope.nextPage = function () {
        $scope.currentPage++;
    }

    $scope.prevPage = function () {
        $scope.currentPage--;
    }

    $scope.goToPage = function(page) {
        $scope.currentPage = page;
    }


    getVideos();

    $scope.dates = "all";
    $scope.view = "Grid";
    $scope.sortBy = "Date Added (newest-oldest)";
    $scope.sermons = [];
    $scope.fromDate = null;
    $scope.toDate = null;
    $scope.speakers = [];
    $scope.topics = [];
    $scope.passages = [];
    $scope.modalTitle = "";
    $scope.updateModal = function(sermon) {
        $scope.modalTitle = sermon.title;
        $scope.iframesrc = $sce.trustAsResourceUrl("http://www.youtube.com/embed/" + sermon.videoId + "?enablejsapi=1&version=3&playerapiid=ytplayer");
    }
    $scope.modalTitle = "Hello";
    $scope.searchText = {
        passage: "",
        topic: "",
        speaker: ""
    };

    $scope.$watch("dates", function() {
        if ($scope.dates == "all") {
            $scope.fromDate = null;
            $scope.toDate = null;
        } else if ($scope.dates == "week") {
            $scope.fromDate = new Date();
            $scope.toDate = new Date();
            $scope.fromDate.setDate($scope.fromDate.getDate() - 7);
        } else if ($scope.dates == "month") {
            $scope.fromDate = new Date();
            $scope.toDate = new Date();
            $scope.fromDate.setDate($scope.fromDate.getDate() - 31);
        }
    });

    $scope.updateDate = function() {

    }
}]);

sermonPage.filter("pageFilter", function() {
    return function(items, page) {
        console.log(page);
        if (page < 0) {
            return items;
        }
        var first = (page - 1) * 12;
        var result = [];
        result = items.slice(first, first+12);
        console.log(result);
        return result;
    }
});

sermonPage.filter("dateFilter", function() {
    return function(items, from, to) {
        if (from == null || to == null) {
            return items;
        }
        var fromDate = new Date(from);
        var toDate = new Date(to);
        var result = [];
        for (var i = 0; i < items.length; i++) {
            var itemDate = new Date(items[i].date);
            if (itemDate >= fromDate && itemDate <= toDate) {
                result.push(items[i]);
            }
        }

        return result;
    }
});

sermonPage.filter("orderFilter", function() {
    return function(items, val) {
        if (val == "Date Added (newest-oldest)") {
            items.sort(function(a, b) {
                var dateA = new Date(a.date);
                var dateB = new Date(b.date);
                if (dateA < dateB) {
                    return 1;
                } else {
                    return -1;
                }
            });
            return items;
        } else if (val == "Date Added (oldest-newest)") {
            items.sort(function(a, b) {
                var dateA = new Date(a.date);
                var dateB = new Date(b.date);
                if (dateA < dateB) {
                    return -1;
                } else {
                    return 1;
                }
            });
            return items;
        } else if (val == "Most Popular") {
            items.sort(function(a, b) {
                if (a.viewCount < b.viewCount) {
                    return -1;
                } else {
                    return 1;
                }
            });
            return items;
        }
    }
});
$(document).ready(function() {
    $('#myModal').on('hide.bs.modal', function(e) {
        $("#ytframe")[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    });
});
</script>
<!-- End Angular -->
<div class="container" ng-app="sermonPage" ng-controller="mainController">
    <div class="left">
        <div style="margin-top:20px;">
            <div class="right-inner-addon">
                <span class="glyphicon glyphicon-search"></span>
<!--                <input type="text" class="form-control search" ng-model="searchText.$" placeholder="Search for...">-->
                <input type="text" class="form-control search" ng-model="rawSearch" ng-blur="search(rawSearch)" placeholder="Search for...">
            </div>
            <!-- /input-group -->
        </div>
        <!-- /.col-lg-6 -->
        <br />
        <h2>FILTER SEARCH:</h2>
        <h3>DATE</h3>
        <p>
            <input type='radio' ng-model="dates" value="all" /><span style="cursor:pointer;" ng-click="dates = 'all'"> All Dates</span>
            <br />
            <input type="radio" ng-model="dates" value="week" /><span style="cursor:pointer;" ng-click="dates = 'week'"> Last Week</span>
            <br />
            <input type="radio" ng-model="dates" value="month" /><span style="cursor:pointer;" ng-click="dates = 'month'"> Last Month</span>
            <br />
            <input type="radio" ng-model="dates" value="range" /><span style="cursor:pointer;" ng-click="dates = 'range'"> Use Date Range</span>
            <br />
            <div class="date-left"><span>From:</span></div>
            <div class="date-right">
                <input type="text" ng-model="fromDateText" ng-change="updateDate()" class="form-control" id='datetimepicker1'/>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script>
            <div class="date-left"><span>To:</span></div>
            <div class="date-right">
                <input type="text" ng-model="toDateText" ng-change="updateDate()" id='datetimepicker2'/>
            </div>
        </p>
        <h3>SPEAKER</h3>
        <p>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{searchText.speaker == '' ? '(none selected)' : searchText.speaker}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="searchText.speaker = ''">(none selected)</a></li>
                    <li ng-repeat="speaker in speakers"><a ng-click="searchText.speaker = speaker">{{speaker}}</a></li>
                </ul>
            </div>
        </p>
        <h3>TOPIC</h3>
        <p>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{searchText.topic == '' ? '(none selected)' : searchText.topic}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="searchText.topic = ''">(none selected)</a></li>
                    <li ng-repeat="topic in topics"><a ng-click="searchText.topic = topic">{{topic}}</a></li>
                </ul>
            </div>
        </p>
        <h3>PASSAGE</h3>
        <p>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{searchText.passage == '' ? '(none selected)' : searchText.passage}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="searchText.passage = ''">(none selected)</a></li>
                    <li ng-repeat="passage in passages"><a ng-click="searchText.passage = passage">{{passage}}</a></li>
                </ul>
            </div>
        </p>
    </div>
    <div class="right">
        <div class="center">
            <h2>SERMONS & WEEKLY MEETINGS</h2>
            <div ng-show="searchText.$ != null && searchText.$ != ''">
                <span class="searchResultText"><span class="searchResults">{{searchResult.length}} results</span> found for "{{searchText.$}}"</span>
            </div>
        </div>
        <div style="width:100%; height: 30pt;">
            <div class="dropdown" style="float:right;">
                <button style="width:54pt;" class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{view}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="width: 54pt;" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="view = 'Grid'">Grid</a></li>
                    <li><a ng-click="view = 'List'">List</a></li>
                </ul>
            </div>
            <div class="dropdown" style="float:right; margin-right: 10px;">
                <button style="width:168pt;" class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{sortBy}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="sortBy = 'Date Added (newest-oldest)'">Date Added (newest-oldest)</a></li>
                    <li><a ng-click="sortBy = 'Date Added (oldest-newest)'">Date Added (oldest-newest)</a></li>
                    <li><a ng-click="sortBy = 'Most Popular'">Most Popular</a></li>
                </ul>
            </div>
        </div>
        <div style="width: 100%">
            <div ng-show="searchResult.length == 0">No results</div>
            <div ng-repeat="sermon in searchResult = (allSermons | filter:searchText | dateFilter:fromDate:toDate | orderFilter:sortBy | pageFilter:currentPage | limitTo: 12)" class="sermon-container" ng-class="{'sermon-container-list' : (view == 'List')}">
                <div class="sermon-video" ng-class="{'sermon-video-list' : (view == 'List')}">
                    <a data-toggle="modal" data-target="#myModal" ng-click="updateModal(sermon);"><img width="100%" height="auto" ng-src="{{sermon.image}}" /></a>
                </div>
                <div class="sermon-container-header">
                    {{sermon.title}}
                </div>
                <div class="sermon-container-text">
                    {{sermon.subtitle}}
                </div>
                <div class="sermon-container-text">
                    {{sermon.date | date : "mediumDate"}}
                </div>
            </div>
        </div>
        <button ng-disabled="currentPage <= 1" ng-click="prevPage()">Prev page</button>
        <button ng-click="nextPage()">Next page</button>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{modalTitle}}</h4>
                </div>
                <div class="modal-body" style="height: 260px; padding:0;">
                    <p>
                        <iframe id="ytframe" width="100%" height="100%" ng-src="{{iframesrc}}" frameborder="0" allowfullscreen></iframe>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
