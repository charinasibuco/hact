/**
 * Created by Owner on 4/14/2016.
 */
$('.sticky-search').hide().prop('disabled',true);
$('.search-bar').show().prop('disabled',false);
$(document).ready(function(){
    $('.sticky-search').hide().prop('disabled',true);
    $('.search-bar').show().prop('disabled',false);
});
$(document).scroll(function() {
    var y = $(this).scrollTop();
    if (y > 50) {
        $('.sticky-search').show().prop('disabled',false);
        $('.search-bar').hide().prop('disabled',true);
    } else {
        $('.sticky-search').hide().prop('disabled',true);
        $('.search-bar').show().prop('disabled',false);
    }
});