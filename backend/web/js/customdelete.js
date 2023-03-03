var tables = ['parentsannouncements', 'classassignments', 'exammarks', 'testmarks', 'class', 'student', 'user',];

var i = 0; 

$(".mikdele").click(function () {
	var id = $(this).attr('rel');
	
 if (confirm('Deleting will delete all the data from corresponding tables.Are you sure?'))
            {
                $.ajax({
                    type: 'post',
                    url: 'deletealltable?id=' + id,
                    data: 'tablename=' + tables[i],
                    success: function (data) {
                        $.notify(data, {
                            type: 'success',
                            allow_dismiss: true,
                            delay: 3000,
                            timer: 3000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                        });
                        i++;
                        delete_recursion(tables[i], id);
                    }
                });
            }
});
function delete_recursion(tablename, id)
{
    if (i < 7) {
        $.ajax({
            type: 'post',
            url: 'deletealltable?id=' + id,
            data: 'tablename=' + tablename,
            success: function (data) {
                $.notify(data, {
                    type: 'success',
                    allow_dismiss: false,
                    delay: 3000,
                    timer: 3000,
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                });
                i++;
              delete_recursion(tables[i], id);
            }
        });
    } /*   else
    {
       location.reload(); 
    } */  
}