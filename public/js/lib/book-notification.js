module.exports = {
    init(){
        if(window.Laravel.userId !== null) {
            window.Echo.private('CodeEduUser.Models.User.'+window.Laravel.userId)
                .notification(notification => {
                   console.log(notification);
                });
        }
    }
};
