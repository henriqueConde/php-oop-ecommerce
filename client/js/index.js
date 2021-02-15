/*-----LOGIN/REGISTER MODAL LISTENERS-----*/
$('.login').on('click', function(){
    if($('.login').text().trim() == "Login"){
        $('.login-section').show();
    }
})

$('.close').on('click', function(){
    $('.login-section').hide();
    $('.register-section').hide();
})

$('.register-here').on('click', function(){
    $('.login-section').hide();
    $('.register-section').show();
})

$('.btn-register').on('click', function(){
    $('.register-section').hide();
})



/*----Hover User Profile----------*/

$('.user-profile').on('click', function(e){
    if($('.fa-user').hasClass('hidden') == false){
        $('.profile-hover-menu').toggle();
    }
})



