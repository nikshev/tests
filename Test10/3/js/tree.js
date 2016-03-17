/**
 * Created by eugene on 3/16/16.
 */
$( document ).ready( function( ) {

    //Add drag feature to list
    $('ul').sortable({
        axis: 'y',
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
        }
    });

    //Add level onClick event
    $('a[class="add-level"]').click( function( ) {
        //console.log("Id="+$(this).data("id")+"; parent id="+$(this).data("parentid"));
        var $parent_id=$(this).data("parentid");
        var $parent_li=$(this).parent().parent();
        $parent_li.find('.level-input').css('display','block');
        $parent_li.find('.level-link').css('display','none');
        $('a[class="save-level"]').click(function( ) {
            var $new_level=$(this).parent().find("input").val();
            $parent_li.find('.level-input').css('display','none');
            $parent_li.find('.level-link').css('display','block');
            if ($new_level.length>0){
                $(this).parent().find("input").val('');
                var $parent=$(this).parent().parent();
                $.ajax({
                    type: "POST",
                    url: 'add.php',
                    data: {name:$new_level, parent_id:$parent_id}
                }).done(function ($id) {
                    //Add Item in group
                    $.ajax({
                        type: "POST",
                        url: 'add.php',
                        data: {name:$new_level, parent_id:$id}
                    }).done(function ($id) {

                    });
                    $group='<li class="parent"><a data-id='+$id+' data-parentid='+$parent_id+' class="link">'+$new_level+'</a><span class="delete" style="color:blue">&nbspDelete</span><span class="input-span"><input type="text" /><a class="save" style="color:blue">&nbsp;Save</a></span><ul>'
                    $group+= "<li>";
                    $group+= '<span class="level-link"><a class="add-level" data-id="-1" data-parentid="' + $parent_id + '">';
                    $group+= "Add level";
                    $group+= "</a></span>";
                    $group+='<span class="level-input"><input type="text" /><a class="save-level" style="color:blue">&nbsp;Save</a></span>';
                    $group+= "</li>";
                    $group+= "<li>";
                    $group+= '<span class="item-link"><a class="add-item" data-id="0" data-parentid="' + $parent_id + '">';
                    $group+= "Add item";
                    $group+= "</a></span>";
                    $group+='<span class="item-input"><input type="text" /><a class="save-item" style="color:blue">&nbsp;Save</a></span>';
                    $group+= "</li>";
                    $group+= "</ul>";
                    $group+= "</li>";
                    $parent.append($group);
                    update_events();
                    copyEvents($('a[class="add-level"]'),$('a[class="add-level"]'));
                    copyEvents($('a[class="save-level"]'),$('a[class="save-level"]'));
                    copyEvents($('a[class="add-item"]'),$('a[class="add-item"]'));
                    copyEvents($('a[class="save-item"]'),$('a[class="save-item"]'));
                });
            }
        });
    });


    //Add item onClick event
    $( 'a[class="add-item"]' ).click( function( ) {
        var $parent_id=$(this).data("parentid");
        if ($parent_id==undefined)
            $parent_id=0;
        var $parent_li=$(this).parent().parent();
        $parent_li.find('.item-input').css('display','block');
        $parent_li.find('.item-link').css('display','none');
        $('a[class="save-item"]').click(function( ) {
            var $new_item=$(this).parent().find("input").val();
            $(this).parent().parent().find('.item-input').css('display','none');
            $(this).parent().parent().find('.item-link').css('display','block');
            if ($new_item.length>0){
                $(this).parent().find("input").val('');
                var $parent=$(this).parent().parent();
                $.ajax({
                    type: "POST",
                    url: 'add.php',
                    data: {name:$new_item, parent_id:$parent_id}
                }).done(function ($id) {
                    if ($parent_id>0)
                        $parent.append('<li><a data-id='+$id+' data-parentid='+$parent_id+' class="link">'+$new_item+'</a><span class="delete" style="color:blue">&nbspDelete</span><span class="input-span"><input type="text" /><a class="save" style="color:blue">&nbsp;Save</a></span></li>');
                    else
                        $parent.append('<li><a data-id='+$id+' class="link">'+$new_item+'</a><span class="delete" style="color:blue">&nbspDelete</span><span class="input-span"><input type="text" /><a class="save" style="color:blue">&nbsp;Save</a></span></li>');
                });
            }
        });
    });


    //Delete element
    $('span[class="delete"]').click(function(){
        if (confirm('Are you sure want to delete?')) {
            var $id=$(this).parent().find('.link').data("id");
            console.log($id);
            $.ajax({
                type: "POST",
                url: 'delete.php',
                data: {id:$id}
            }).done(function () {
                window.location.reload(false);
            });
        }
    });

    //Show input for rename
    $('a[class="link"]').dblclick(function(){
       $(this).parent().children('.input-span').css("display","block");
       $(this).parent().children('.input-span').find('input').val('');
       $(this).parent().children('.delete').css("display","none");
       $(this).css("display","none");
    });

    //Save new text and close input
    $('a[class="save"]').click(function(){
        $(this).parent().parent().children('.input-span').css("display","none");
        $new_value=$(this).parent().parent().children('.input-span').find('input').val();
        $(this).parent().parent().children('.delete').css("display","block");
        var $id=$(this).parent().parent().children('.link').data("id");
        var $parent_id=$(this).parent().parent().children('.link').data("parentid");
        $(this).parent().parent().children('.link').text($new_value);
        $.ajax({
            type: "POST",
            url: 'edit.php',
            data: {name:$new_value, id:$id, parent_id:$parent_id}
        }).done(function () {

        });
        $(this).parent().parent().children('.link').css("display","block");
    });

    update_events();
});

/**
 * Update events which need for tree
 */
function update_events(){

    //Add drag feature to list
    $('ul').sortable({
        axis: 'y',
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
        }
    });

    $( '.tree li' ).each( function() {
        if( $( this ).children( 'ul' ).length > 0 ) {
            $( this ).addClass( 'parent' );
        }
    });

    $( '.tree li.parent > a' ).unbind("click");
    $( '.tree li.parent > a' ).click( function( ) {
        $( this ).parent().toggleClass( 'active' );
        $( this ).parent().children( 'ul' ).slideToggle( 'fast' );
    });

    $( '#all' ).click( function() {
        $( '.tree li' ).each( function() {
            $( this ).toggleClass( 'active' );
            $( this ).children( 'ul' ).slideToggle( 'fast' );
        });
    });


}


//Copy Events from elements
function copyEvents(source, destination) {
    var events;

    //copying from one to one or more
    source = $(source).first();
    destination = $(destination);
    //get all the events from the source
    events = $(source).data('events');
    if (!events) return;

    //make copies of all events for each destination
    destination.each(function() {
        var t = $(this);
        $.each(events, function(index, event) {
            $.each(event, function(i, v) {
                t.bind(v.type, v.handler);
            });
        });
    });
}