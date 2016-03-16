/**
 * Created by eugene on 3/16/16.
 */
$( document ).ready( function( ) {


    $( 'a[class="add-level"]' ).click( function( ) {
        //console.log("Id="+$(this).data("id")+"; parent id="+$(this).data("parentid"));
        var parent_id=$(this).data("parentid");
        $('.level-input').css('display','block');
        $('.level-link').css('display','none');
        $('a[class="save-level"]').click(function( ) {
            var $new_level=$(this).parent().find("input").val();
            if ($new_level.length>0){
                $('.level-input').css('display','none');
                $('.level-link').css('display','block');
                $(this).parent().find("input").val('');
                update_events();
            }
        });
    });


    $( 'a[class="add-item"]' ).click( function( ) {
        //console.log("Id="+$(this).data("id")+"; parent id="+$(this).data("parentid"));
        var parent_id=$(this).data("parentid");
        var $parent_ul=$(this).parent().parent().parent().parent();
        console.log($parent_ul);
        $('.item-input').css('display','block');
        $('.item-link').css('display','none');
        $('a[class="save-item"]').click(function( ) {
            var $new_item=$(this).parent().find("input").val();
            if ($new_item.length>0){
                $('.item-input').css('display','none');
                $('.item-link').css('display','block');
                $(this).parent().find("input").val('');
                var $item_count=$parent_ul.length;//.insertBefore('<li><a>'+$new_item+'</a></li>');
                $item_pos=$item_count-3;
                var $parent_li=$parent_ul.find("li").eq($item_pos);
                console.log($parent_li.html());
                $parent_li.after('<li><a>'+$new_item+'</a></li>');

                update_events();
            }
        });
    });

    update_events();

});

/**
 * Update events which need for tree
 */
function update_events(){
    $( '.tree li' ).each( function() {
        if( $( this ).children( 'ul' ).length > 0 ) {
            $( this ).addClass( 'parent' );
        }
    });

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