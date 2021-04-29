// loggin toggle
$('.message a').click(function() {
    $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
});

// $.ajax({

//     var userName = doc.getId().value;


//     var jsondata = {
//         'username': userName,
//     };

//     url: 'api/login',
//     method: 'POST',
//     data: jsondata,

//     success: finction(){
//         alert('Success')
//     },
//     error: function(){
//         alert('Error');
//     }

// });