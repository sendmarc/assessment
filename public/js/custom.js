$('[data-toggle=delete-task]').confirm({
    theme: 'black',
    animationBounce: 2.5,
    closeIcon: true,
    cancelButton:'Cancel',
    icon: 'fa fa fa-trash fa-2x',
    title:'Delete A Campaign!!!',
    content: 'Are you sure you want to delete a campaign?',
    type: 'red',
    draggable: false,
    buttons: {
        tryAgain: {
            text:  ' Delete',
            btnClass: 'btn-blue fa fa-plus',
            action: function(){
                $("#deleteTask").submit()
            }
        },
        cancel: function () {

        }
    }
});
