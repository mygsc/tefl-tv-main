var divList = $("#subscriberLists");
divList.sort(function(a, b){
    return $(a).data("subscriberList")-$(b).data("subscriberList")
});
$("#list").html(divList);