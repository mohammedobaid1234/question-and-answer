require('./bootstrap');

require('alpinejs');

console.log('object2');
window.Echo.private(`Notifications.${userId}`)
.notification(function(data){
    console.log(`${data.body}`);    
    $('#not').prepend(`
         <li id="not" >${data.body}</li>
    `); 
    
});