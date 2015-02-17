/**
 * Created by nikshev on 17.02.15.
 * Main js functions
 */

jQuery(document).ready(function(){

    jQuery("#first").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=first_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#last").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=last_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#phone").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=phone_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#phone").on("focusout",function (){
      var str=jQuery("#phone").val();
      if (str.length==0)
      {
          jQuery.ajax({
              type: "POST",
              url: "/forge/tooltip.php",
              data: "const=phone_error",
              success: function(msg){
                  alert("Error:"+msg);
              }
          });
      }
    });

    jQuery("#newlogin").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=newlogin_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#newlogin").on("focusout",function (){
        var str=jQuery("#newlogin").val();
        if (str.length==0)
        {
            jQuery.ajax({
                type: "POST",
                url: "/forge/tooltip.php",
                data: "const=email_error",
                success: function(msg){
                    alert("Error:"+msg);
                }
            });
        }
    });

    jQuery("#pwd").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=pwd_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#av").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=av_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#birth").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=birth_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#marital").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=marital_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#ed").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=ed_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#ex").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=ex_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

    jQuery("#ad").on("keydown click",function (){
        jQuery.ajax({
            type: "POST",
            url: "/forge/tooltip.php",
            data: "const=ad_tt",
            success: function(msg){
                jQuery("#tooltip").html(msg);
            }
        });
    });

});