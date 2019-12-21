var base_url = script_vars.base_url;
var template_url = script_vars.template_url;

$(document).ready(function(){

    $('.sidebartoggler').on('click',function(e){
        e.preventDefault();
        $('#sidebarNav').css({
            'width': '250px',
            'border-right': '3px solid #e5e5e5',
            'left': '0'
        });
    })

    $(document).click(function (event) {
        event.stopPropagation();

        if (event.target.id == 'sidebarNav' || $(event.target).parents('#sidebarNav').length > 0) {
            console.log('inside');
        } else {
            if (!$('.sidebartoggler').has(event.target).length) {
                closeSidebarNav();
            }
        }
    });

    // $('.widget-content ul').addClass('list-unstyled p-2');

    function closeSidebarNav() {
        $('#sidebarNav').css({
            'width': '0',
            'border-right': 'none',
            'left': '-250px'
        });
    }

});